<?php

require_once './api/controllers/api.controller.php';
require_once './api/models/album.api.model.php';
require_once './api/view/api.view.php';

class AlbumApiController extends ApiController {

    public function __construct() {
        parent::__construct();
        $this->model = new AlbumApiModel();
    }

    public function getAlbums($params = []) {

        $sort = ( !empty($_GET['sort']) && $this->model->columnExists($_GET['sort']) ) ? $_GET['sort'] : 'album_id';
        $order = ( !empty($_GET['order']) && $_GET['order'] == 1 ) ? 'DESC' : 'ASC';
        $name = ( !empty($_GET['name'])) ? $_GET['name'] : '';
        $artist = ( !empty($_GET['artist']) ) ? $_GET['artist'] : '';
        $newer = ( !empty($_GET['newer']) ) ? $_GET['newer'] : 0;
        $older = ( !empty($_GET['older']) ) ? $_GET['older'] : 3000;
        $label = ( !empty($_GET['label']) ) ? $_GET['label'] : '';

        $page = ( !empty($_GET['page']) ) ? (int)$_GET['page'] : 1;
        $show = ( !empty($_GET['show']) ) ? (int)$_GET['show'] : 10;
        $offset = ($page - 1) * $show;
        
        $albums = $this->model->getAlbums($sort, $order, $name, $artist, $newer, $older, $label, $show, $offset);

        //si $albums contiene resultado, lo enviamos al response
        if ($albums) {
            $this->view->response([
                'data' => $albums,
                'status' => 'success'
            ], 200);
        }
        
        //si $albums vuelve vacio, y existe un parametro de busqueda, no se encontro resultado
        if ( ($name != '') || ($artist != '') || ($label != '') ) {
            $this->view->response([
                'data' => 'No se encontraron resultados, revise sus parametros de busqueda',
                'status' => 'error'
            ], 404);
        }

        $this->view->response([
            'data' => 'No se pudo completar la solicitud',
            'status' => 'error'
        ], 500);
    }
    
    public function getAlbum($params = []) {
        
        $id = $params[':ID'];
        $album = $this->model->getAlbumById($id);
    
        if ($album) {
            return $this->view->response([
                'data' => $album,
                'status' => 'success'
            ], 200);
        } else {
            return $this->view->response([
                'data' => 'Album no encontrado',
                'status' => 'error'
            ], 404);
        }
    }
}