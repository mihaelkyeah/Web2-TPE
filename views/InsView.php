<?php
// vista: interfaz del usuario (frontend)
// TODO: IMPLEMENTAR HERENCIA
require_once('libs/Smarty.class.php');

class InsView {

    // ====== INICIO BLOQUE A HEREDAR DE VIEW.PHP ======

    private $smarty;

    function __construct() {
        $username = AuthHelper::getLoggedUserName();
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

    // Muestra instrumentos por categoría
    public function viewCategIns($instruments,$category) {
        $this->smarty->assign('pageName','Instruments by category: '.$category);
        $this->smarty->assign('pageTitle',$category);
        $this->smarty->assign('instruments',$instruments);
        $this->smarty->display('templates/list_ins.tpl');
    }

    // Muestra todos los instrumentos
    public function viewAllIns($instruments) {
        $this->smarty->assign('pageName','All instruments');
        $this->smarty->assign('pageTitle','All instruments');
        $this->smarty->assign('instruments',$instruments);
        $this->smarty->display('templates/list_ins.tpl');
    }

    // Muestra los detalles de un instrumento
    public function viewInsDetail($instrument,$categoryArray,$categIndex) {
        $this->smarty->assign('pageName','Instrument details: '.$instrument->ins_name);
        $this->smarty->assign('pageTitle','Instrument details');
        $this->smarty->assign('instrument',$instrument);
        $this->smarty->assign('categArray',$categoryArray);
        $this->smarty->assign('categIndex',$categIndex);
        $this->smarty->display('templates/detail_ins.tpl');
    }

    // Muestra el formulario para crear un instrumento nuevo
    public function showFormIns($categoryArray) {
        $this->smarty->assign('pageName','Crate new instrument');
        $this->smarty->assign('pageTitle','New entry');
        $this->smarty->assign('type','instrument');
        $this->smarty->assign('categArray',$categoryArray);
        $this->smarty->display('templates/new_entry.tpl');
    }

}

?>