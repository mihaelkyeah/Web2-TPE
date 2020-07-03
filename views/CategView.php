<?php
// vista: interfaz del usuario (frontend): categorías
require_once('views/View.php');

class CategView extends View {

    public $isadmin;

    function __construct($isadmin = null) {
        parent::__construct();
        if(isset($isadmin))
            $this->isadmin = $isadmin;
            $this->getSmarty()->assign('isadmin',$this->isadmin);
    }

    // Muestra todas las categorías
    function viewCategories($categories,$isadmin) {
        $this->getSmarty()->assign('pageName','Categories');
        $this->getSmarty()->assign('pageTitle','Categories');
        $this->getSmarty()->assign('categories',$categories);
        $this->getSmarty()->display('templates/list_categ.tpl');
    }

    // Muestra detalles de una categoría
    function viewCategDetail($category,$isadmin) {
        $this->getSmarty()->assign('pageName','Category details: '.$category->name);
        $this->getSmarty()->assign('pageTitle','Category details');
        $this->getSmarty()->assign('category',$category);
        $this->getSmarty()->display('templates/detail_categ.tpl');
    }

    // Muestra el formulario para crear una categoría nueva
    public function showFormCateg() {
        $this->getSmarty()->assign('pageName','Crate new category');
        $this->getSmarty()->assign('pageTitle','New entry');
        $this->getSmarty()->assign('type','category');
        $this->getSmarty()->display('templates/new_entry.tpl');
    }

}

?>