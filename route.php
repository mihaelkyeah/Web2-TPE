<?php

// require_once('controllers/..');

if($_GET['action'] == '')
    $_GET['action'] = 'home';

$urlParts = explode('/' $_GET['action']);

switch($urlParts[0]) {
    case 'home':

    break;

    default:
        echo('<h1>Error 404 - No encontrado');
    break;
}

?>