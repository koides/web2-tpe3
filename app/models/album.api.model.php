<?php

require_once './app/models/api.model.php';

class AlbumApiModel extends ApiModel {

    public function getAlbums($id = null) {
        
        if ( !isset($id) ) {
            $query = $this->db->prepare('SELECT * FROM albumes ORDER BY album_nombre');
            $query->execute();
    
            $albums = $query->fetchAll(PDO::FETCH_OBJ);
            return $albums;
        }

        $query = $this->db->prepare('SELECT * FROM albumes WHERE album_id=?');
        $query->execute([$id]);

        $album = $query->fetch(PDO::FETCH_OBJ);
        return $album;
    }
}