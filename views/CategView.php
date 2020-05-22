<?php
// vista: interfaz del usuario (frontend)
require_once('libs/Smarty.class.php');

class CategView {

    private $smarty;

    function __construct() {
        $authHelper = new AuthHelper();
        $username = $authHelper->getLoggedUsername();
        $this->smarty = new Smarty();
        $this->smarty->assign('baseURL',BASE_URL);
        $this->smarty->assign('username',$username);
    }

    function viewCategories($categories) {
        $this->smarty->assign('pageName','Categories');
        $this->smarty->assign('pageTitle','Categories');
        $this->smarty->assign('categories',$categories);
        $this->smarty->display('templates/list_categ.tpl');
    }

    function viewCategDetail($category) {
        $this->smarty->assign('pageName','Category details: '.$category->categ_name);
        $this->smarty->assign('pageTitle','Category details');
        $this->smarty->assign('category',$category);
        $this->smarty->display('templates/detail_categ.tpl');
    }

}

?>