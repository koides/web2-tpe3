<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/comment.api.model.php';
require_once './app/view/api.view.php';

class CommentApiController extends ApiController {
    private $albumModel;
    
    public function __construct() {
        parent::__construct();
        $this->model = new CommentApiModel();
        $this->albumModel = new AlbumApiModel();
    }

    public function getComment($params = []) {
        if ( empty($params) ) {
            $comments = $this->model->getComment();
            return $this->view->response(200, $comments);
        }

        $id = $params[':ID'];
        $comment = $this->model->getComment($id);

        if ( !empty($comment) ) {
            return $this->view->response(200, $comment);
        } else {
            return $this->view->response(404);
        }
    }

    public function saveComment($params = []) {
        //getData devuelve el objeto json recibido por POST
        $body = $this->getData();

        $comentario = $body->comentario;
        $puntuacion = $body->puntuacion;
        $album = $body->album;

        if ( empty($params) ) {
            try {
                $this->model->saveComment($comentario, $puntuacion, $album);
                $this->view->response(201);
            } catch (Exception $ex) {
                $this->view->response(400);
            }
        } else {
            //verificamos que el comentario exista
            $commentId = $params[':ID'];
            $comment = $this->model->getComment($commentId);
    
            if ( $comment ) {
                try {
                    $this->model->saveComment($comentario, $puntuacion, $album, $commentId);
                    $this->view->response(200);
                } catch (Exception $ex) {
                    $this->view->response(500);
                }
            } else {
                $this->view->response(404);
            }
        }
    }

    public function deleteComment($params = []) {
        $id = $params[':ID'];
        $comment = $this->model->getComment($id);

        if ( $comment ) {
            $this->model->deleteComment($id);
            $this->view->response(204);
        } else {
            $this->view->response(404);
        }
    }
}