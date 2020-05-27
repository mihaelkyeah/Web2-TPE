<?php
// controlador: coordinador entre vista y modelo (usuarios)

require_once('views/UserView.php');
require_once('models/UserModel.php');

class UserController {

    private $model;
    private $view;
    public $is_admin;

    public function __construct() {
        $this->view = new UserView();
        $this->model = new UserModel();
    }

    // Muestra la principal
    public function showHome() {
        $this->view->showHome();
    }

    // Muestra el formulario de inicio de sesión
    public function showLogin() {
        $this->view->showLogin();
    }

    // Verificación del usuario ingresado comparándolo con un usuario de la base de datos
    public function verify() {
        if(!empty($_POST['username']) && !empty($_POST['password'])) {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $userDB = $this->model->getUserByUsername($user);

            if(!empty($userDB) && password_verify($pass, $userDB->pass)) {
                AuthHelper::login($userDB);
                header('Location: '. BASE_URL .'home');
                // $msg = ("Welcome, ".$userDB->username); (*)
                // $this->view->showHome($msg); (*)
            }
            else {
                $this->view->showLogin("Incorrect username or password.");
                die;
            }
        }
        else {
            $this->view->showLogin("Login credentials missing.");
            die;
        }
    }

    // Muestra el panel de control del usuario actual
    public function viewProfile() {
        AuthHelper::getLoggedIn();
        $this->view->viewProfile(($_SESSION['ID USER']), ($_SESSION['ISADMIN']));
    }

    // Cierre de sesión
    public function logout() {
        AuthHelper::logout();
        // $this->view->showHome("You have logged out."); (*)
        header('Location: '. BASE_URL .'home');
    }

}

/**
 * (*): Quería mostrar los textos "Welcome, [nombre de usuario]" cuando se inicia la sesión,
 * y "You have logged out." cuando se cierra, ambos mostrados en el home.
 */

?>