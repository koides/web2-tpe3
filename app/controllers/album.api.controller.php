<?php

require_once './app/models/album.api.model.php';
require_once './app/view/api.view.php';

class AlbumApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new AlbumApiModel();
        $this->view = new ApiView();
    }

    public function getAlbums($params = null) {
        $albums = $this->model->getAlbums();
        return $this->view->response($albums, 200);
    }
}