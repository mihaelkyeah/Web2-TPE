<?php

require_once('controllers/InsController.php');
require_once('controllers/CategController.php');
require_once('controllers/UserController.php');

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if($_GET['action'] == '') {
    $_GET['action'] = 'home';
}

$urlParts = explode('/', $_GET['action']);

$categoryArray = initCategArray();
function initCategArray() {
    $controller = new CategController();
    $categArray = $controller->getCategoryArray();
    return $categArray;
}

switch($urlParts[0]) {
    case 'home':
        $controller = new UserController();
        $controller->showHome();
    break;
    case 'login':
        $controller = new UserController();
        $controller->showLogin();
    break;
    case 'verify':
        $controller = new UserController();
        $controller->verify();
    break;
    case 'instruments': 
        $controller = new InsController();
        if (sizeof($urlParts)==1) {
            $controller->showAllInstruments();
        }
        else {
            $category = ($categoryArray[($urlParts[1])-1])->categ_name;
            $controller->showCategoryInstruments($urlParts[1],$category);
        }
    break;
    case 'details':
        switch($urlParts[1]) {
            case 'instrument':
                $controller = new InsController();
                $controller->showInstrumentDetail($urlParts[2]);
            break;
            case 'category':
                $controller = new CategController();
                $controller->showCategoryDetail($urlParts[2]);
            break;
            default:
                echo "Error";
            break;
        }
    break;
    case 'new-ins':
        $controller = new InsController();
        $controller->addIns();
    break;
    case 'delete-ins':
        $controller = new InsController();
        $controller->deleteIns($urlParts[1]);
    break;
    case 'categories':
        $controller = new CategController();
        $controller->showAllCategory();
    break;
    case 'new-categ':
        $controller = new CategController();
        $controller->addCateg();
    break;
    case 'delete-categ':
        $controller = new CategController();
        $controller->deleteCateg($urlParts[1]);
    break;
    default:
        echo "<h1>Error 404 - Page not found </h1>";
    break;
}

?>