<?php

require_once './api/controllers/api.controller.php';
require_once './api/models/song.api.model.php';
require_once './api/view/api.view.php';

class SongApiController extends ApiController {

    public function __construct() {
        parent::__construct();
        $this->model = new SongApiModel();
    }

    public function getSongs($params = []) {

        $sort = ( !empty($_GET['sort']) && $this->model->columnExists($_GET['sort']) ) ? $_GET['sort'] : 'cancion_id';
        $order = ( !empty($_GET['order']) && $_GET['order'] == 1 ) ? 'DESC' : 'ASC';
        $name = ( !empty($_GET['name'])) ? $_GET['name'] : '';
        $albumId = ( !empty($_GET['album_id']) ) ? $_GET['album_id'] : null;
        $longer = ( !empty($_GET['longer']) ) ? $_GET['longer'] : 0;
        $shorter = ( !empty($_GET['shorter']) ) ? $_GET['shorter'] : 100000;
        $track = ( !empty($_GET['track']) ) ? $_GET['track'] : null;

        $page = ( !empty($_GET['page']) ) ? (int)$_GET['page'] : 1;
        $show = ( !empty($_GET['show']) ) ? (int)$_GET['show'] : 10;
        $offset = ($page - 1) * $show;

        $songs = $this->model->getSongs($sort, $order, $name, $albumId, $longer, $shorter, $track, $show, $offset);

        //si $songs contiene resultado, lo enviamos al response
        if ($songs) {
            $this->view->response([
                'data' => $songs,
                'status' => 'success'
            ], 200);
        }
        
        //si $songs vuelve vacio, y existe un parametro de busqueda, no se encontro resultado
        if ( ($name != '') || ($albumId != null) || ($track != null) ) {
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
    
    public function getSongById($params = []) {
        
        $id = $params[':ID'];
        $song = $this->model->getSongById($id);
    
        if ($song) {
            return $this->view->response([
                'data' => $song,
                'status' => 'success'
            ], 200);
        } else {
            return $this->view->response([
                'data' => 'Cancion no encontrada',
                'status' => 'error'
            ], 404);
        }
    }
}