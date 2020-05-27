<?php
// vista: interfaz del usuario (frontend)
require_once('views/View.php');

class UserView extends View {

    function __construct() {
        parent::__construct();
    }

    // Muestra el panel de usuario
    function viewProfile($iduser,$isadmin) {
        $this->getSmarty()->assign('pageName','User Control Panel');
        $this->getSmarty()->assign('pageTitle','User Control Panel');
        $this->getSmarty()->assign('iduser',$iduser);
        $this->getSmarty()->assign('isadmin',$isadmin);
        $this->getSmarty()->display('templates/user_ctrlPanel.tpl');
    }

    // Muestra formulario de inicio de sesión
    public function showLogin($error=null) {
        $this->getSmarty()->assign('pageName', 'User Login');
        $this->getSmarty()->assign('pageTitle', 'Login');
        $this->getSmarty()->assign('error',$error);
        $this->getSmarty()->display('templates/user_login.tpl');
    }

    // Muestra la página principal
    public function showHome($msg=null) {
        $this->getSmarty()->assign('pageName', 'Home');
        $this->getSmarty()->assign('pageTitle', 'Corador Musical Instruments');
        $this->getSmarty()->assign('msg',$msg);
        $this->getSmarty()->display('templates/home.tpl');
    }

}

?>