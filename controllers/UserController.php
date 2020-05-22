<?php

require_once('views/UserView.php');
require_once('models/UserModel.php');

class UserController {

    private $model;
    private $view;
    private $authHelper;
    public $isadmin;

    public function __construct() {
        $this->view = new UserView();
        $this->model = new UserModel();
        $this->authHelper = new AuthHelper();
        // TODO init user model
    }

    public function showHome() {
        $this->view->showHome();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function verify() {
        if(!empty($_POST['username']) && !empty($_POST['password'])) {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $userDB = $this->model->getUserByUsername($user);

            if(!empty($userDB) && password_verify($pass, $userDB->pass)) {
                session_start();
                $_SESSION['ID USER'] = $userDB->id_user;
                $_SESSION['USERNAME'] = $userDB->username;
                header('Location: '. BASE_URL .'home');
                // $msg = ("Welcome, ".$userDB->username);
                $this->view->showHome($msg);
                $this->isadmin = $userDB->is_admin;
            }
            else {
                $this->view->showLogin("Login incorrecto");
            }
        }
    }

    public function viewProfile() {
        var_dump($this->isadmin);
        $this->view->viewProfile($this->isadmin);
    }

    public function logout() {
        session_start();
        session_destroy();
        // $this->view->showHome("You have logged out.");
        header('Location: '. BASE_URL .'home');
    }

}

?>