<?php
// vista: interfaz del usuario (frontend)
require_once('libs/Smarty.class.php');

class InsView {

    private $smarty;

    function __construct() {
        $authHelper = new AuthHelper();
        $username = $authHelper->getLoggedUsername();
        $this->smarty = new Smarty();
        $this->smarty->assign('baseURL',BASE_URL);
        $this->smarty->assign('username',$username);
    }

    public function viewCategIns($instruments,$category) {
        $this->smarty->assign('pageName','Instruments by category: '.$category);
        $this->smarty->assign('pageTitle',$category);
        $this->smarty->assign('instruments',$instruments);
        $this->smarty->display('templates/list_ins.tpl');
    }

    public function viewAllIns($instruments) {
        $this->smarty->assign('pageName','All instruments');
        $this->smarty->assign('pageTitle','All instruments');
        $this->smarty->assign('instruments',$instruments);
        $this->smarty->display('templates/list_ins.tpl');
    }

    public function viewInsDetail($instrument) {
        $this->smarty->assign('pageName','Instrument details: '.$instrument->ins_name);
        $this->smarty->assign('pageTitle','Instrument details');
        $this->smarty->assign('instrument',$instrument);
        $this->smarty->display('templates/detail_ins.tpl');
    }

}

?>