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

    public function showFormCateg() {
        $this->smarty->assign('pageName','Crate new category');
        $this->smarty->assign('pageTitle','New entry');
        $this->smarty->assign('type','category');
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