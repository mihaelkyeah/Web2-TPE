<?php

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
                $this->is_admin = $userDB->is_admin;
                header('Location: '. BASE_URL .'home');
                // $msg = ("Welcome, ".$userDB->username);
                // $this->view->showHome($msg);
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

    public function viewProfile() {
        var_dump($this->is_admin);
        $this->view->viewProfile($this->is_admin);
    }

    public function logout() {
        session_start();
        session_destroy();
        // $this->view->showHome("You have logged out.");
        header('Location: '. BASE_URL .'home');
    }

}

?>