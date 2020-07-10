<?php

require_once('libs/Router.php');
require_once('api/APIController.php');

// Crear un objeto basado en la clase Router
$router = new Router();

// Definir la tabla de ruteo
$router->addRoute('comments/:ID_ins','GET','APIController','getComments');
$router->addRoute('comment','POST','APIController','postComment');
$router->addRoute('comment/:ID_comm','DELETE','APIController','deleteComment');

$router->route($_REQUEST['resource'], $_SERVER['REQUEST_METHOD']);