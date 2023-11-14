<?php

require_once './api/models/api.model.php';

class CommentApiModel extends ApiModel {

    public function getComments($sort, $order, $comment, $albumId, $higher, $lower, $show, $offset) {
        
        $query = $this->db->prepare(
            'SELECT * FROM comentarios
            WHERE comentario LIKE ?
            AND (? IS NULL OR album = ?)
            AND puntuacion BETWEEN ? AND ?
            ORDER BY ? ?
            LIMIT ?
            OFFSET ?'
        );
        
        //$query->execute([('%'.$name.'%'), $albumId, $albumId, $longer, $shorter, $track, $track, $sort, $order, $show, $offset]);
    
        //en ves de pasar un arreglo con los paremetros en execute(), lo que parametriza cada variable como una string
        //atamos individualmente los parametros para obligar que $show y $offset se pasen con tipo primitivo int 
        //necesario para que el query funcione

        $query->bindValue(1, ('%' . $comment . '%'));
        $query->bindValue(2, $albumId);
        $query->bindValue(3, $albumId);
        $query->bindValue(4, $higher);
        $query->bindValue(5, $lower);
        $query->bindValue(6, $sort);
        $query->bindValue(7, $order);
        $query->bindValue(8, $show, PDO::PARAM_INT);
        $query->bindValue(9, $offset, PDO::PARAM_INT);

        $query->execute();

        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }
    
    public function getCommentById($id) {
        
        $query = $this->db->prepare('SELECT * FROM comentarios WHERE comentario_id=?');
        $query->execute([$id]);
    
        $comment = $query->fetch(PDO::FETCH_OBJ);
        return $comment;
    }

    public function saveComment($comentario, $puntuacion, $album, $id = null) {
        if ( isset($id) ) {

            $query = $this->db->prepare('UPDATE comentarios SET comentario=?, puntuacion=?, album=? WHERE comentario_id=?');
            $query->execute([$comentario, $puntuacion, $album, $id]);

            $comment = $this->getCommentById($this->db->lastInsertId());
            return $comment;
        } else {

            $query = $this->db->prepare('INSERT INTO comentarios (comentario, puntuacion, album) VALUES (?, ?, ?)');
            $query->execute([$comentario, $puntuacion, $album]);

            $comment = $this->getCommentById($this->db->lastInsertId());
            return $comment;
        }
    }

    public function deleteComment($id) {
        $query = $this->db->prepare('DELETE FROM comentarios WHERE comentario_id=?');
        $query->execute([$id]);
    }

    public function columnExists($column) {

        $query = $this->db->prepare('SHOW COLUMNS FROM comentarios LIKE ?');
        $query->execute([$column]);

        $exists = $query->fetch(PDO::FETCH_COLUMN);
        return $exists;
    }
}