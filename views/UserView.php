<?php
// vista: interfaz del usuario (frontend)
// TODO: IMPLEMENTAR HERENCIA
require_once('libs/Smarty.class.php');
require_once('helpers/auth.helper.php');

class UserView {

    // ====== INICIO BLOQUE A HEREDAR DE VIEW.PHP ======

    private $smarty;

    function __construct() {
        $username = AuthHelper::getLoggedUserName();
        $this->smarty = new Smarty();
        $this->smarty->assign('baseURL',BASE_URL);
        $this->smarty->assign('username',$username);
    }

    // ====== FIN BLOQUE A HEREDAR DE VIEW.PHP ======

    // Muestra el panel de usuario
    function viewProfile($iduser,$isadmin) {
        $this->smarty->assign('pageName','User Control Panel');
        $this->smarty->assign('pageTitle','User Control Panel');
        $this->smarty->assign('iduser',$iduser);
        $this->smarty->assign('isadmin',$isadmin);
        $this->smarty->display('templates/user_ctrlPanel.tpl');
    }

    // Muestra formulario de inicio de sesión
    public function showLogin($error=null) {
        $this->smarty->assign('pageName', 'User Login');
        $this->smarty->assign('pageTitle', 'Login');
        $this->smarty->assign('error',$error);
        $this->smarty->display('templates/user_login.tpl');
    }

    // Muestra la página principal
    public function showHome($msg=null) {
        $this->smarty->assign('pageName', 'Home');
        $this->smarty->assign('pageTitle', 'Corador Musical Instruments');
        $this->smarty->assign('msg',$msg);
        $this->smarty->display('templates/home.tpl');
    }

}

?>