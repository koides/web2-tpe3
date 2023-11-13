<?php

require_once './api/models/api.model.php';

class AlbumApiModel extends ApiModel {

    public function getAlbums($sort, $order, $older, $newer, $artist) {
        
        $query = $this->db->prepare('SELECT * FROM albumes WHERE anio BETWEEN ? AND ? AND artista LIKE ? ORDER BY ? ?');
        $query->execute([$newer, $older, ('%'.$artist.'%'), $sort, $order]);

        $albums = $query->fetchAll(PDO::FETCH_OBJ);
        return $albums;       
    }

    public function getAlbumsById($id) {

        $query = $this->db->prepare('SELECT * FROM albumes WHERE album_id=?');
        $query->execute([$id]);
    
        $album = $query->fetch(PDO::FETCH_OBJ);
        return $album;
    }

    public function columnExists($column) {

        $query = $this->db->prepare('SHOW COLUMNS FROM albumes LIKE ?');
        $query->execute([$column]);

        $exists = $query->fetch(PDO::FETCH_COLUMN);
        return $exists;
    }
}