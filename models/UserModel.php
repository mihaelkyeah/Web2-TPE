<?php

class UserModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_corador;charset=utf8', 'root', '');
    }

    public function getUserByUsername($username) {
        $query = $this->db->prepare('SELECT * FROM `user` WHERE username = ?');
        $query->execute([$username]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

}

?>