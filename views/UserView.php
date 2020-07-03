<?php
// vista: interfaz del usuario (frontend)
require_once('views/View.php');

class UserView extends View {

    function __construct() {
        parent::__construct();
    }

    // Muestra el panel de usuario
    function viewProfile($iduser,$isadmin) {
        var_dump($isadmin);
        $this->getSmarty()->assign('pageName','User Control Panel');
        $this->getSmarty()->assign('pageTitle','User Control Panel');
        $this->getSmarty()->assign('iduser',$iduser);
        $this->getSmarty()->assign('isadmin',$isadmin);
        $this->getSmarty()->display('templates/user_ctrlPanel.tpl');
    }

    // Muestra formulario de inicio de sesión
    public function viewLogin($error=null) {
        $this->getSmarty()->assign('pageName', 'User Login');
        $this->getSmarty()->assign('pageTitle', 'Login');
        $this->getSmarty()->assign('error',$error);
        $this->getSmarty()->assign('formType',false); // si es false, inicia sesión
        $this->getSmarty()->display('templates/user_form.tpl');
    }

    public function viewSignupForm($error=null) {
        $this->getSmarty()->assign('pageName', 'Account registration');
        $this->getSmarty()->assign('pageTitle', 'Sign up');
        $this->getSmarty()->assign('error',$error);
        $this->getSmarty()->assign('formType',true); // si es true, registra un usuario
        $this->getSmarty()->display('templates/user_form.tpl');
    }

    // Muestra la página principal
    public function viewHome($msg=null) {
        $this->getSmarty()->assign('pageName', 'Home');
        $this->getSmarty()->assign('pageTitle', 'Corador Musical Instruments');
        $this->getSmarty()->assign('msg',$msg);
        $this->getSmarty()->display('templates/home.tpl');
    }

    public function viewUserList($users) {
        $this->getSmarty()->assign('pageName', 'Users List - Admin Control Panel');
        $this->getSmarty()->assign('pageTitle', 'Users List');
        $this->getSmarty()->assign('users',$users);
        $this->getSmarty()->display('templates/user_userList.tpl');
    }

}

?>