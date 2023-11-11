<?php

require_once './app/models/api.model.php';

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

    public function addComment() {

    }
}