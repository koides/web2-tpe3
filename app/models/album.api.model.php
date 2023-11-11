<?php

class AlbumApiModel {
    private $db;
    
    public function __construct() {
        $this->db = new PDO(DB_CONNECT_STRING, DB_USER, DB_PASS);
    }

    public function getAlbums() {
        $query = $this->db->prepare('SELECT * FROM albumes ORDER BY album_nombre');
        $query->execute();

        $albums = $query->fetchAll(PDO::FETCH_OBJ);
        return $albums;
    }
}