<?php

require_once './api/models/api.model.php';

class SongApiModel extends ApiModel {

    public function getSongs($id = null) {
        
        if ( !isset($id) ) {
            $query = $this->db->prepare('SELECT * FROM canciones ORDER BY cancion_nombre');
            $query->execute();
    
            $songs = $query->fetchAll(PDO::FETCH_OBJ);
            return $songs;
        }

        $query = $this->db->prepare('SELECT * FROM canciones WHERE cancion_id=?');
        $query->execute([$id]);

        $song = $query->fetch(PDO::FETCH_OBJ);
        return $song;
    }
}