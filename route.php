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

    // Operaciones de usuario

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
    case 'logout':
        $controller = new UserController();
        $controller->logout();
    break;
    case 'user':
        $controller = new UserController();
        $controller->viewProfile();
    break;

    // Navegación del sitio: instrumentos y categorías

    case 'instruments': 
        $controller = new InsController();
        if (sizeof($urlParts)==1) {
            $controller->showAllInstruments();
        }
        else {
            /**
             * Como los ID de las categorías pueden variar al crear algunas y borrar otras,
             * y no siempre van a guardar una relación con el índice del arreglo que las contiene,
             * decidí usar array_search para encontrar el índice del arreglo de categorías
             * que contenga la categoría con el id_categ correspondiente.
             */
            $categIndex = array_search($urlParts[1], array_column($categoryArray,'id_categ'));
            $category = $categoryArray[$categIndex]->categ_name;
            $controller->showCategoryInstruments($urlParts[1],$category);
        }
    break;
    case 'categories':
        $controller = new CategController();
        $controller->showAllCategory();
    break;
    case 'details':
        switch($urlParts[1]) {
            case 'instrument':
                $controller = new InsController();
                $controller->showInstrumentDetail($urlParts[2],$categoryArray);
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

    // Edición de la BD: instrumentos y categorías

    case 'formnew':
        switch($urlParts[1]) {
            case 'instrument':
                $controller = new InsController();
                $controller->showFormInstrument($categoryArray);
            break;
            case 'category':
                $controller = new CategController();
                $controller->showFormCategory();
            break;
            default:
                echo "Error";
            break;
        }
    break;
    case 'create':
        switch($urlParts[1]) {
            case 'instrument':
                $controller = new InsController();
                $controller->addInstrument();
            break;
            case 'category':
                $controller = new CategController();
                $controller->addCategory();
            break;
            default:
                echo "Error";
            break;
        }
    break;
    case'update':
        switch($urlParts[1]) {
            case 'instrument':
                $controller = new InsController();
                $controller->updateInstrument($urlParts[2]);
            break;
            case 'category':
                $controller = new CategController();
                $controller->updateCategory($urlParts[2]);
            break;
            default:
                echo "Error";
            break;
        }
    break;
    case 'delete':
        switch($urlParts[1]) {
            case 'instrument':
                $controller = new InsController();
                $controller->deleteInstrument($urlParts[2]);
            break;
            case 'category':
                $controller = new CategController();
                $controller->deleteCategory($urlParts[2]);
            break;
            default:
                echo "Error";
            break;
        }
    break;

    default:
        echo "<h1>Error 404 - Page not found </h1>";
    break;
}

?>