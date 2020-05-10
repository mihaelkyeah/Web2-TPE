<?php
// modelo: acceso a BD; interacción directa con la tabla `instrument`

class InsModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_corador;charset=utf8', 'root', '');
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'db_corador';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password)
        }
        catch (Exception $e) {
            echo(var_dump($e));
        }
    }

    /**
     * @return array
     * Retorna todos los instrumentos ordenados por categoría
     */

    public function getAllIns() {
        $query = $this->db->prepare('SELECT * FROM `instrument` ORDER BY `id_categ_fk`');
        $query->execute();
        $return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return array
     * Devuelve todos los instrumentos de una determinada categoría
     */

    public function getCategoryIns($categId) {
        $query = $this->db->prepare('SELECT * FROM `instrument` WHERE `id_categ_fk` = ?');
        $query->execute([$categId]);
        // ^ forma alternativa de tipear $query->execute(array($catId));
        $return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Agrega un instrumento nuevo
     */

    public function saveIns($name, $price, $details, $insCateg) {
        $query = $this->db->prepare('INSERT INTO `instrument` (`ins_name`, `price`, `details`, `id_categ_fk`) VALUES (? ? ? ?)');
        return $query->execute([$name,$price,$details,$insCateg]);
    }

    public function deleteIns($id) {
        $query = $this->db->prepare('DELETE FROM `instrument` WHERE `id_instrument` = ?');
        return ($query->execute([$id]));
    }

}

?>