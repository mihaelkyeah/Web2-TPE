<?php
// vista: interfaz del usuario (frontend)
require_once('views/View.php');

class InsView extends View {

    function __construct($isadmin = null) {
        parent::__construct();
        if(isset($isadmin)) {
            $this->getSmarty()->assign('isadmin',$isadmin);
        }
    }

    // Muestra instrumentos por categoría
    public function viewCategIns($instruments,$category,$isadmin) {
        $this->getSmarty()->assign('pageName','Instruments by category: '.$category);
        $this->getSmarty()->assign('pageTitle',$category);
        $this->getSmarty()->assign('instruments',$instruments);
        $this->getSmarty()->display('templates/list_ins.tpl');
    }

    // Muestra todos los instrumentos
    public function viewAllIns($instruments,$isadmin) {
        $this->getSmarty()->assign('pageName','All instruments');
        $this->getSmarty()->assign('pageTitle','All instruments');
        $this->getSmarty()->assign('instruments',$instruments);
        $this->getSmarty()->display('templates/list_ins.tpl');
    }

    // Muestra los detalles de un instrumento
    public function viewInsDetail($instrument,$categoryArray,$categIndex,$isadmin) {
        $this->getSmarty()->assign('pageName','Instrument details: '.$instrument->ins_name);
        $this->getSmarty()->assign('pageTitle','Instrument details');
        $this->getSmarty()->assign('instrument',$instrument);
        $this->getSmarty()->assign('categArray',$categoryArray);
        $this->getSmarty()->assign('categIndex',$categIndex);
        $this->getSmarty()->display('templates/detail_ins.tpl');
    }

    // Muestra el formulario para crear un instrumento nuevo
    public function showFormIns($categoryArray) {
        $this->getSmarty()->assign('pageName','Crate new instrument');
        $this->getSmarty()->assign('pageTitle','New entry');
        $this->getSmarty()->assign('type','instrument');
        $this->getSmarty()->assign('categArray',$categoryArray);
        $this->getSmarty()->display('templates/new_entry.tpl');
    }

}

?>