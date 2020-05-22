<?php

require_once('views/UserView.php');

class UserController {

    private $model;
    private $view;

    public function __construct() {
        $this->view = new UserView();
        // TODO init user model
    }

    public function showHome() {
        $this->view->showHome();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function verify() {
        if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $user = $_POST['username'];
            $pass = $_POST['email'];
            $pass = $_POST['password'];
            echo ($user .' '. $pass);
        }
        else {
            echo('Invalid username!<br>');
            // Esto es un script dentro de un HTML dentro de un PHP... No sé cuántos puntos voy a perder por esto xdxdxd
            echo('<a href=# onclick="window.history.back()">Go back</a>');
        }
    }

}

?>