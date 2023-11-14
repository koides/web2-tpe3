<?php

require_once './api/models/api.model.php';

class AlbumApiModel extends ApiModel {

    public function getAlbums($sort, $order, $name, $artist, $newer, $older, $label, $show, $offset) {
       
        $query = $this->db->prepare(
            'SELECT * FROM albumes  
            WHERE album_nombre LIKE ? 
            AND artista LIKE ? 
            AND anio BETWEEN ? AND ?
            AND discografica LIKE ? 
            ORDER BY ? ?
            LIMIT ?
            OFFSET ?'
        );
        
        //$query->execute([('%'.$name.'%'), ('%'.$artist.'%'), $newer, $older, ('%'.$label.'%'), $sort, $order, $show, $offset]);

        //en ves de pasar un arreglo con los paremetros en execute(), lo que parametriza cada variable como una string
        //atamos individualmente los parametros para obligar que $show y $offset se pasen con tipo primitivo int 
        //necesario para que el query funcione
        
        $query->bindValue(1, ('%' . $name . '%'));
        $query->bindValue(2, ('%' . $artist . '%'));
        $query->bindValue(3, $newer);
        $query->bindValue(4, $older);
        $query->bindValue(5, ('%' . $label . '%'));
        $query->bindValue(6, $sort);
        $query->bindValue(7, $order);
        $query->bindValue(8, $show, PDO::PARAM_INT);
        $query->bindValue(9, $offset, PDO::PARAM_INT);
        
        $query->execute();

        $albums = $query->fetchAll(PDO::FETCH_OBJ);
        return $albums;       
    }

    public function getAlbumById($id) {

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