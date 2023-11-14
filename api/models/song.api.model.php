<?php

require_once './api/models/api.model.php';

class SongApiModel extends ApiModel {

    public function getSongs($sort, $order, $name, $albumId, $longer, $shorter, $track, $show, $offset) {
        
        $query = $this->db->prepare(
            'SELECT * FROM canciones
            WHERE cancion_nombre LIKE ?
            AND (? IS NULL OR album = ?)
            AND duracion BETWEEN ? AND ?
            AND (? IS NULL OR track = ?)
            ORDER BY ? ?
            LIMIT ?
            OFFSET ?'
        );
        
        //$query->execute([('%'.$name.'%'), $albumId, $albumId, $longer, $shorter, $track, $track, $sort, $order, $show, $offset]);
    
        //en ves de pasar un arreglo con los paremetros en execute(), lo que parametriza cada variable como una string
        //atamos individualmente los parametros para obligar que $show y $offset se pasen con tipo primitivo int 
        //necesario para que el query funcione

        $query->bindValue(1, ('%' . $name . '%'));
        $query->bindValue(2, $albumId);
        $query->bindValue(3, $albumId);
        $query->bindValue(4, $longer);
        $query->bindValue(5, $shorter);
        $query->bindValue(6, $track);
        $query->bindValue(7, $track);
        $query->bindValue(8, $sort);
        $query->bindValue(9, $order);
        $query->bindValue(10, $show, PDO::PARAM_INT);
        $query->bindValue(11, $offset, PDO::PARAM_INT);

        $query->execute();

        $songs = $query->fetchAll(PDO::FETCH_OBJ);
        return $songs;
    }
    
    public function getSongById($id) {
        
        $query = $this->db->prepare('SELECT * FROM canciones WHERE cancion_id=?');
        $query->execute([$id]);
        
        $song = $query->fetch(PDO::FETCH_OBJ);
        return $song;
    }

    public function columnExists($column) {

        $query = $this->db->prepare('SHOW COLUMNS FROM albumes LIKE ?');
        $query->execute([$column]);

        $exists = $query->fetch(PDO::FETCH_COLUMN);
        return $exists;
    }
}