<?php
// vista: interfaz del usuario (frontend)
require_once('libs/Smarty.class.php');
require_once('helpers/auth.helper.php');

class UserView {

    private $smarty;

    function __construct() {
        $authHelper = new AuthHelper();
        $username = $authHelper->getLoggedUsername();
        $this->smarty = new Smarty();
        $this->smarty->assign('baseURL',BASE_URL);
        $this->smarty->assign('username',$username);
    }

    //  TODO panel del usuario
    function viewProfile($isadmin) {
        $this->smarty->assign('pageName','User Control Panel');
        $this->smarty->assign('pageTitle','User Control Panel');
        // $this->smarty->assign('user',$user);
        $this->smarty->assign('isadmin',$isadmin);
        $this->smarty->display('templates/user_ctrlPanel.tpl');
    }

    public function showLogin($error=null) {
        $this->smarty->assign('pageName', 'User Login');
        $this->smarty->assign('pageTitle', 'Login');
        $this->smarty->assign('error',$error);
        $this->smarty->display('templates/user_login.tpl');
    }

    public function showHome($msg=null) {
        $this->smarty->assign('pageName', 'Home');
        $this->smarty->assign('pageTitle', 'Corador Musical Instruments');
        $this->smarty->assign('msg',$msg);
        $this->smarty->display('templates/home.tpl');
    }

}

?>