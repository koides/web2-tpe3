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
        if ( empty($params) ) {
            $songs = $this->model->getSongs();
            return $this->view->response(200, $songs);
        }

        $id = $params[':ID'];
        $song = $this->model->getSongs($id);

        if ( !empty($song) ) {
            return $this->view->response(200, $song);
        } else {
            return $this->view->response(404);
        }
    }
}