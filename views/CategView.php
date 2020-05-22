<?php
// vista: interfaz del usuario (frontend)
require_once('libs/Smarty.class.php');
class CategView {

    public $navbar;

    public function __construct() {
        $this->navbar = array(
            BASE_URL.'home' ,
            BASE_URL.'instruments' ,
            BASE_URL.'categories'
        );
    }

    function viewCategories($categories) {
        $smarty = new Smarty();
        $smarty->assign('pageName','Categories');
        $smarty->assign('pageTitle','Categories');
        $smarty->assign('categories',$categories);
        $smarty->assign('baseURL',BASE_URL);
        $smarty->assign('navbar',$this->navbar);
        $smarty->display('templates/list_categ.tpl');
    }

    function viewCategDetail($category) {
        $smarty = new Smarty();
        $smarty->assign('pageName','Category details: '.$category->categ_name);
        $smarty->assign('pageTitle','Category details');
        $smarty->assign('category',$category);
        $smarty->assign('baseURL',BASE_URL);
        $smarty->assign('navbar',$this->navbar);
        $smarty->display('templates/detail_categ.tpl');
    }

}

?>