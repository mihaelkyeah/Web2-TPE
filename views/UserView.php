<?php
// vista: interfaz del usuario (frontend)
require_once('libs/Smarty.class.php');
class UserView {

    public $navbar;

    public function __construct() {
        $this->navbar = array(
            BASE_URL.'home' ,
            BASE_URL.'instruments' ,
            BASE_URL.'categories'
        );
    }

    //  TODO panel del usuario
    function viewProfile() {
        $smarty = new Smarty();
        $smarty->assign(`title`,`User Control Panel`);
        // . . . . . . . . . . . . . . .
        // Cambiar contraseña
        // Cerrar sesión
        $smarty->assign('baseURL',BASE_URL);
        $smarty->assign('navbar',$this->navbar);
        $smarty->display('templates/userCtrlPanel.tpl');
    }

    public function showLogin() {
        $smarty = new Smarty();
        $smarty->assign('pageName', 'User Login');
        $smarty->assign('pageTitle', 'Login');
        $smarty->assign('baseURL',BASE_URL);
        $smarty->assign('navbar',$this->navbar);
        $smarty->display('templates/user_login.tpl');
    }

    public function showHome() {
        $smarty = new Smarty();
        $smarty->assign('pageName', 'Home');
        $smarty->assign('pageTitle', 'Corador Musical Instruments');
        $smarty->assign('baseURL',BASE_URL);
        $smarty->assign('navbar',$this->navbar);
        $smarty->display('templates/home.tpl');
    }

}

?>