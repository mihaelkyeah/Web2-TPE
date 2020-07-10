<?php

require_once('libs/Smarty.class.php');
require_once('helpers/auth.helper.php');

class View {
    
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
        $this->smarty->assign('baseURL',BASE_URL);
        
        $username = AuthHelper::getLoggedUserName();
        $userID = AuthHelper::getLoggedUserID();
        $this->getSmarty()->assign('username',$username);
        $this->getSmarty()->assign('userID',$userID);
    }

    public function showError($msg1,$msg2) {
        $this->smarty->assign('pageName','Error');
        $this->smarty->assign('pageTitle','Error');
        $this->smarty->assign('msg1',$msg1);
        $this->smarty->assign('msg2',$msg2);
        $this->smarty->display('templates/error.tpl');
    }

    public function getSmarty() {
        return $this->smarty;
    }

}

?>