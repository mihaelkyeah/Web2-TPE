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

    public function viewInsDetail($instrument,$categoryArray,$categIndex) {
        $this->smarty->assign('pageName','Instrument details: '.$instrument->ins_name);
        $this->smarty->assign('pageTitle','Instrument details');
        $this->smarty->assign('instrument',$instrument);
        $this->smarty->assign('categArray',$categoryArray);
        $this->smarty->assign('categIndex',$categIndex);
        $this->smarty->display('templates/detail_ins.tpl');
    }

    public function showFormIns($categoryArray) {
        $this->smarty->assign('pageName','Crate new instrument');
        $this->smarty->assign('pageTitle','New entry');
        $this->smarty->assign('type','instrument');
        $this->smarty->assign('categArray',$categoryArray);
        $this->smarty->display('templates/new_entry.tpl');
    }

    public function showError($msg1,$msg2) {
        $this->smarty->assign('pageName','Error');
        $this->smarty->assign('pageTitle','Error');
        $this->smarty->assign('msg1',$msg1);
        $this->smarty->assign('msg2',$msg2);
        $this->smarty->display('templates/error.tpl');
    }

}

?>