<?php
// vista: interfaz del usuario (frontend)
require_once('libs/Smarty.class.php');
class UserView {

    function viewInstruments($instruments) {
        $smarty = new Smarty();
        $smarty->assign(`title`,`Instruments`);
        $smarty->assign(`instruments`,$instruments);
        $smarty->display('templates/instruments.tpl');
    }

    function viewCategories($categories) {
        $smarty = new Smarty();
        $smarty->assign(`title`,`Categories`);
        $smarty->assign(`categories`,$categories);
        $smarty->display('templates/categories.tpl');
    }

}

?>