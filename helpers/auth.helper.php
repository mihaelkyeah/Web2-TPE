<?php

class AuthHelper {
    
    /**
     * @return string or null
     * Devuelve el valor de $_SESSION['USERNAME'] para verificar que hay una sesión activa.
     * Si no, devuelve null.
     */
    static private function start() {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();
    }

    static public function login($user) {
        self::start();
        $_SESSION['ISLOGGED'] = true;
        $_SESSION['ID USER'] = $user->id;
        $_SESSION['USERNAME'] = $user->username;
        $_SESSION['ISADMIN'] = $user->admin;
    }
    
    static public function getLoggedUserName() {
        self::start();
        if(isset($_SESSION['USERNAME']))
            return $_SESSION['USERNAME'];
        else
            return null;
    }

    static public function getLoggedUserID() {
        self::start();
        if(isset($_SESSION['ID USER']))
            return $_SESSION['ID USER'];
        else
            return null;
    }

    static public function getUserAdmin() {
        self::start();
        if(isset($_SESSION['ISADMIN']))
            return($_SESSION['ISADMIN']);
        else
            return null;
    }

    static public function getLoggedIn() {
        if(!isset($_SESSION['ISLOGGED'])) {
            header('Location:' .BASE_URL. 'login');
            die;
        }
    }

    static public function getPermission() {
        self::start();
        $isadmin = AuthHelper::getUserAdmin();
        if($isadmin == "0" || $isadmin == null) {
            /**
             * Si se inicia sesión como administrador sobre una sesión de usuario normal,
             * se sobreescribe la sesión anterior.
             */
            header('Location:' .BASE_URL. 'login');
            die;
        }
    }

    // Método extra para evitar que un usuario ya logueado pueda entrar al formulario
    // de login o de registro
    static public function getLoggedStatus() {
        if(isset($_SESSION['ISLOGGED'])) {
            return true;
        }
        else {
            return false;
        }
    }

    static public function logout() {
        self::start();
        session_destroy();
    }

}

?>