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
        
        $sort = ( !empty($_GET['sort']) && $this->model->columnExists($_GET['sort']) ) ? $_GET['sort'] : "album_nombre";
        $order = ( !empty($_GET['order']) && $_GET['order'] == 1 ) ? 'DESC' : 'ASC';
        $older = ( !empty($_GET['older']) ) ? $_GET['older'] : 3000;
        $newer = ( !empty($_GET['newer']) ) ? $_GET['newer'] : 0;
        $artist = ( !empty($_GET['artist']) ) ? $_GET['artist'] : "";

        $albums = $this->model->getAlbums($sort, $order, $older, $newer, $artist);
        return $this->view->response(200, $albums);
    }
    
    public function getAlbum($params = []) {
        
        $id = $params[':ID'];
        $album = $this->model->getAlbumById($id);
    
        if ( !empty($album) ) {
            return $this->view->response(200, $album);
        } else {
            return $this->view->response(404);
        }
    }
}