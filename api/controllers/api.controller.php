<?php

class ApiController {
    protected $model;
    protected $view;
    private $data;

    public function __construct() {
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    public function getData(){
        return json_decode($this->data);
    }

    public function error($params = []) {
        $this->view->response([
            'data' => 'No es posible procesar la solicitud',
            'status' => 'error'
        ], 400);
    }
}