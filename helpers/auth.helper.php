<?php

class AuthHelper {

    public function getLoggedUserName() {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();
        return $_SESSION['USERNAME'];
    }

}

?>