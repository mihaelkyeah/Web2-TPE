<?php

class AuthHelper {
    
    /**
     * @return string or null
     * Devuelve el valor de $_SESSION['USERNAME'] para verificar que hay una sesión activa.
     * Si no, devuelve null.
     */
    public function getLoggedUserName() {

        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();
            
        if(isset($_SESSION['USERNAME']))
            return $_SESSION['USERNAME'];
        else
            return null;
            
    }

}

?>