<?php
require_once './api/config/config.php';
require_once './api/libs/router.api.php';
require_once './api/controllers/album.api.controller.php';
require_once './api/controllers/song.api.controller.php';
require_once './api/controllers/comments.api.controller.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('albums',         'GET',      'AlbumApiController',       'getAlbums');
$router->addRoute('albums/:ID',     'GET',      'AlbumApiController',       'getAlbum');

$router->addRoute('songs',          'GET',      'SongApiController',        'getSongs');
$router->addRoute('songs/:ID',      'GET',      'SongApiController',        'getSongs');

$router->addRoute('comments',       'GET',      'CommentApiController',     'getComment');
$router->addRoute('comments/:ID',   'GET',      'CommentApiController',     'getComment');
$router->addRoute('comments',       'POST',     'CommentApiController',     'saveComment');
$router->addRoute('comments/:ID',   'PUT',      'CommentApiController',     'saveComment');
$router->addRoute('comments/:ID',   'DELETE',   'CommentApiController',     'deleteComment');

// rutea
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);