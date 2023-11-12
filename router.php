<?php
require_once './app/config/config.php';
require_once './app/libs/router.helper.php';
require_once './app/controllers/album.api.controller.php';
require_once './app/controllers/comments.api.controller.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('albums',         'GET',      'AlbumApiController',       'getAlbums');
$router->addRoute('albums/:ID',     'GET',      'AlbumApiController',       'getAlbums');

$router->addRoute('comments',       'GET',      'CommentApiController',     'getComment');
$router->addRoute('comments/:ID',   'GET',      'CommentApiController',     'getComment');
$router->addRoute('comments',       'POST',     'CommentApiController',     'saveComment');
$router->addRoute('comments/:ID',   'PUT',      'CommentApiController',     'saveComment');
$router->addRoute('comments/:ID',   'DELETE',   'CommentApiController',     'deleteComment');

// rutea
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);