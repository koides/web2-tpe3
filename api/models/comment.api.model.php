<?php

require_once './api/models/api.model.php';

class CommentApiModel extends ApiModel {

    public function getComment($id = null) {
        
        if ( !isset($id) ) {
            $query = $this->db->prepare('SELECT * FROM comentarios ORDER BY comentario_id');
            $query->execute();
    
            $comments = $query->fetchAll(PDO::FETCH_OBJ);
            return $comments;
        }

        $query = $this->db->prepare('SELECT * FROM comentarios WHERE comentario_id=?');
        $query->execute([$id]);

        $comment = $query->fetch(PDO::FETCH_OBJ);
        return $comment;
    }

    public function saveComment($comentario, $puntuacion, $album, $id = null) {
        if ( isset($id) ) {
            $query = $this->db->prepare('UPDATE comentarios SET comentario=?, puntuacion=?, album=? WHERE comentario_id=?');
            $query->execute([$comentario, $puntuacion, $album, $id]);
        } else {
            $query = $this->db->prepare('INSERT INTO comentarios (comentario, puntuacion, album) VALUES (?, ?, ?)');
            $query->execute([$comentario, $puntuacion, $album]);
        }
    }

    public function deleteComment($id) {
        $query = $this->db->prepare('DELETE FROM comentarios WHERE comentario_id=?');
        $query->execute([$id]);
    }
}