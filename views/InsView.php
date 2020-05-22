<?php
// vista: interfaz del usuario (frontend)
require_once('libs/Smarty.class.php');
class InsView {

    public $navbar;

    public function __construct() {
        $this->navbar = array(
            BASE_URL.'home' ,
            BASE_URL.'instruments' ,
            BASE_URL.'categories'
        );
    }

    public function viewCategIns($instruments,$category) {
        $smarty = new Smarty();
        $smarty->assign('pageName','Instruments by category: '.$category);
        $smarty->assign('pageTitle',$category);
        $smarty->assign('instruments',$instruments);
        $smarty->assign('baseURL',BASE_URL);
        $smarty->assign('navbar',$this->navbar);
        $smarty->display('templates/list_ins.tpl');
    }

    public function viewAllIns($instruments) {
        $smarty = new Smarty();
        $smarty->assign('pageName','All instruments');
        $smarty->assign('pageTitle','All instruments');
        $smarty->assign('instruments',$instruments);
        $smarty->assign('baseURL',BASE_URL);
        $smarty->assign('navbar',$this->navbar);
        $smarty->display('templates/list_ins.tpl');
    }

    public function viewInsDetail($instrument) {
        $smarty = new Smarty();
        $smarty->assign('pageName','Instrument details: '.$instrument->ins_name);
        $smarty->assign('pageTitle','Instrument details');
        $smarty->assign('instrument',$instrument);
        $smarty->assign('baseURL',BASE_URL);
        $smarty->assign('navbar',$this->navbar);
        $smarty->display('templates/detail_ins.tpl');
    }

}

?>