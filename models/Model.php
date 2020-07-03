<?php
// modelo: acceso a BD
class Model {

    private $db;

    public function __construct() {
        $this->db = $this->createConnection();
    }

    public function createConnection() {
        $db = new PDO('mysql:host=localhost;dbname=db_corador;charset=utf8', 'root', '');
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'db_corador';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
            // Sólo en modo de desarrollo:
            // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        catch (Exception $e) {
            echo(var_dump($e));
        }
        return $db;
    }

    public function getDb() {
        return $this->db;
    }

}

?>