<?php

require_once('controllers/InsController.php');
require_once('controllers/CategController.php');
require_once('controllers/UserController.php');

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if($_GET['action'] == '') {
    $_GET['action'] = 'home';
}

$urlParts = explode('/', $_GET['action']);

// ====== Operaciones asignadas a las URL ======

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
        $controller->showProfile();
    break;
    case 'userlist':
        $controller = new UserController();
        $controller->showUsers();
    break;
    case 'admin': {
        $controller = new UserController();
        $adminTrueFalse = null;
        switch($urlParts[1]) {
            case 'add': {
                $adminTrueFalse = 1; // o true?
            }
            break;
            case 'remove': {
                $adminTrueFalse = 0; // o false?
            }
            break;
        }
        $controller->addremoveAdmin($adminTrueFalse, $urlParts[2]);
    }
    case 'signup':
        $controller = new UserController();
        $controller->showSignUp();
    break;
    case 'register':
        $controller = new UserController();
        $controller->createUser();
    break;
    case 'makeadmin':
        $controller = new UserController();
        $controller->makeAdmin($urlParts[1]);
    break;

    // Navegación del sitio: instrumentos y categorías

    case 'instruments': 
        $controller = new InsController();
        if (sizeof($urlParts)==1) {
            $controller->showAllInstruments();
        }
        else {
            $controller->showCategoryInstruments($urlParts[1]);
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

    // Edición de la BD: instrumentos y categorías

    case 'formnew':
        switch($urlParts[1]) {
            case 'instrument':
                $controller = new InsController();
                $controller->showFormInstrument();
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