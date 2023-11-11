<?php

class CommentApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new CommentApiModel();
        $this->view = new ApiView(); 
    }

    public function addComment() {
        
    }
}