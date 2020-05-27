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
        $_SESSION['ID USER'] = $user->id_user;
        $_SESSION['USERNAME'] = $user->username;
        $_SESSION['ISADMIN'] = $user->is_admin;
    }
    
    static public function getLoggedUserName() {
        self::start();
        if(isset($_SESSION['USERNAME']))
            return $_SESSION['USERNAME'];
        else
            return null;
    }

    static public function getLoggedIn() {
        if(!isset($_SESSION['ISLOGGED'])) {
            header('Location:' .BASE_URL. 'login');
            die;
        }
    }

    static public function logout() {
        self::start();
        session_destroy();
    }

}

?>