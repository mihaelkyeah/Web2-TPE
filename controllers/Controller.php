<?php

require_once('helpers/auth.helper.php');
class Controller {

    /**
     * Al haber implementado este nuevo sistema
     * se me rompió la verificación para mostrar o no el formulario xD
     * Pero sin embargo puedo acceder al formulario sin problemas
     * y puedo crear instrumentos y categorías
     */
    public $isadmin;

    function __construct() {
        $this->isadmin = AuthHelper::getUserAdmin();
    }

}

?>