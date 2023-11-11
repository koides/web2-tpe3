<?php

require_once './app/models/comment.api.model.php';
require_once './app/view/api.view.php';

class CommentApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new CommentApiModel();
        $this->view = new ApiView(); 
    }

    public function getComment($params = []) {
        if ( empty($params) ) {
            $comments = $this->model->getComment();
            return $this->view->response($comments, 200);
        }

        $id = $params[':ID'];
        $comment = $this->model->getComment($id);

        if ( !empty($comment) ) {
            return $this->view->response(200, $comment);
        } else {
            return $this->view->response(404);
        }
    }

    public function addComment() {
        
    }
}