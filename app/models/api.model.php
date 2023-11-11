<?php

class ApiModel {
    protected $db;

    public function __construct(){
        $this->db = new PDO(DB_CONNECT_STRING, DB_USER, DB_PASS);
    }
}