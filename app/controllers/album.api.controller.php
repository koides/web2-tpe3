<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/album.api.model.php';
require_once './app/view/api.view.php';

class AlbumApiController extends ApiController {

    public function __construct() {
        parent::__contruct();
        $this->model = new AlbumApiModel();
    }

    public function getAlbums($params = []) {
        if ( empty($params) ) {
            $albums = $this->model->getAlbums();
            return $this->view->response(200, $albums);
        }

        $id = $params[':ID'];
        $album = $this->model->getAlbums($id);

        if ( !empty($album) ) {
            return $this->view->response(200, $album);
        } else {
            return $this->view->response(404);
        }
    }
}