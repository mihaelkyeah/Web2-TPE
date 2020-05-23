<?php
// vista: interfaz del usuario (frontend): categorías
// TODO: IMPLEMENTAR HERENCIA
require_once('libs/Smarty.class.php');

class CategView {

    // ====== INICIO BLOQUE A HEREDAR DE VIEW.PHP ======

    private $smarty;

    function __construct() {
        $authHelper = new AuthHelper();
        $username = $authHelper->getLoggedUsername();
        $this->smarty = new Smarty();
        $this->smarty->assign('baseURL',BASE_URL);
        $this->smarty->assign('username',$username);
        if(isset($_SESSION['ISADMIN']))
            $this->smarty->assign('isadmin',$_SESSION['ISADMIN']);
    }

    public function showError($msg1,$msg2) {
        $this->smarty->assign('pageName','Error');
        $this->smarty->assign('pageTitle','Error');
        $this->smarty->assign('msg1',$msg1);
        $this->smarty->assign('msg2',$msg2);
        $this->smarty->display('templates/error.tpl');
    }

    // ====== FIN BLOQUE A HEREDAR DE VIEW.PHP ======

    // Muestra todas las categorías
    function viewCategories($categories) {
        $this->smarty->assign('pageName','Categories');
        $this->smarty->assign('pageTitle','Categories');
        $this->smarty->assign('categories',$categories);
        $this->smarty->display('templates/list_categ.tpl');
    }

    // Muestra detalles de una categoría
    function viewCategDetail($category) {
        $this->smarty->assign('pageName','Category details: '.$category->categ_name);
        $this->smarty->assign('pageTitle','Category details');
        $this->smarty->assign('category',$category);
        $this->smarty->display('templates/detail_categ.tpl');
    }

    // Muestra el formulario para crear una categoría nueva
    public function showFormCateg() {
        $this->smarty->assign('pageName','Crate new category');
        $this->smarty->assign('pageTitle','New entry');
        $this->smarty->assign('type','category');
        $this->smarty->display('templates/new_entry.tpl');
    }

}

?>