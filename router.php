<?php
require_once './app/config/config.php';
require_once './app/libs/router.helper.php';
require_once './app/controllers/album.api.controller.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('albums', 'GET', 'AlbumApiController', 'getAlbums');
//$router->addRoute('tareas', 'POST', 'TaskApiController', 'crearTarea');
//$router->addRoute('tareas/:ID', 'GET', 'TaskApiController', 'obtenerTarea');

// rutea
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);