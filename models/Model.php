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

    /**
     * @return string
     * Mueve el archivo subido y le asigna un nombre; retorna el nombre creado.
     * Este método fue movido al model padre porque también será usado para las categorías.
     */
    public function copyImage() {
        // Nombre del archivo original
        $img_OrigName = $_FILES['insImg']['name'];
        // Nombre en el sistema de archivos
        $img_PhysName = $_FILES['insImg']['tmp_name'];
        // Nombre que devuelve la función
        $img_finalName = "img_upload/". uniqid("", true) . "." .strtolower(pathinfo($img_OrigName, PATHINFO_EXTENSION));

        move_uploaded_file($img_PhysName, $img_finalName);

        return $img_finalName;
    }

}

?>