<?php

require_once './api/controllers/api.controller.php';
require_once './api/models/comment.api.model.php';
require_once './api/view/api.view.php';

class CommentApiController extends ApiController {
    private $albumModel;
    
    public function __construct() {
        parent::__construct();
        $this->model = new CommentApiModel();
        $this->albumModel = new AlbumApiModel();
    }

    public function getComments($params = []) {

        $sort = ( !empty($_GET['sort']) && $this->model->columnExists($_GET['sort']) ) ? $_GET['sort'] : 'album_id';
        $order = ( !empty($_GET['order']) && $_GET['order'] == 1 ) ? 'DESC' : 'ASC';
        $comment = ( !empty($_GET['comment']) ) ? $_GET['comment'] : '';
        $albumId = ( !empty($_GET['album_id']) ) ? $_GET['album_id'] : null;
        $higher = ( !empty($_GET['higher']) ) ? $_GET['higher'] : 0;
        $lower = ( !empty($_GET['lower']) ) ? $_GET['lower'] : 10;

        $page = ( !empty($_GET['page']) ) ? (int)$_GET['page'] : 1;
        $show = ( !empty($_GET['show']) ) ? (int)$_GET['show'] : 10;
        $offset = ($page - 1) * $show;

        $comments = $this->model->getComments($sort, $order, $comment, $albumId, $higher, $lower, $show, $offset);

        //si $comments contiene resultado, lo enviamos al response
        if ($comments) {
            $this->view->response([
                'data' => $comments,
                'status' => 'success'
            ], 200);
        }
        
        //si $comments vuelve vacio, y existe un parametro de busqueda, no se encontro resultado
        if ( ($comment != '') || ($albumId != null) ) {
            $this->view->response([
                'data' => 'No se encontraron resultados, revise sus parametros de busqueda',
                'status' => 'error'
            ], 404);
        }

        $this->view->response([
            'data' => 'No se pudo completar la solicitud',
            'status' => 'error'
        ], 500);
    }
    
    public function getCommentById($params = []) {
        
        $id = $params[':ID'];
        $comment = $this->model->getCommentById($id);
    
        if ($comment) {
            return $this->view->response([
                'data' => $comment,
                'status' => 'success'
            ], 200);
        } else {
            return $this->view->response([
                'data' => 'Comentario no encontrada',
                'status' => 'error'
            ], 404);
        }
    }

    public function saveComment($params = []) {
        //getData devuelve el objeto json recibido por POST
        $body = $this->getData();

        $comentario = $body->comentario;
        $puntuacion = $body->puntuacion;
        $album = $body->album;

        if ( empty($params) ) {
            try {
                $comment = $this->model->saveComment($comentario, $puntuacion, $album);

                $this->view->response([
                    'data' => $comment,
                    'status' => 'succes'
                ], 201);
            } catch (Exception $ex) {
                $this->view->response([
                    'data' => 'No se pudo crear el recurso',
                    'status' => 'error'
                ], 500);
            }
        } else {
            //verificamos que el comentario exista
            $commentId = $params[':ID'];
            $comment = $this->model->getCommentById($commentId);
    
            if ( $comment ) {
                try {
                    $this->model->saveComment($comentario, $puntuacion, $album, $commentId);
                    $this->view->response([
                        'data' => $comment,
                        'status' => 'succes'
                    ], 200);
                } catch (Exception $ex) {
                    $this->view->response(500);
                }
            } else {
                $this->view->response([
                    'data' => 'No se encuentra el recurso solicitado',
                    'status' => 'error'
                ], 404);
            }
        }
    }

    public function deleteComment($params = []) {
        $id = $params[':ID'];
        $comment = $this->model->getCommentById($id);

        if ( $comment ) {
            $this->model->deleteComment($id);
            $this->view->response([
                'data' => 'El recurso fue borrado con exito',
                'status' => 'success'
            ], 200);
        } else {
            $this->view->response([
                'data' => 'No se encuentra el recurso solicitado',
                'status' => 'error'
            ], 404);
        }
    }
}