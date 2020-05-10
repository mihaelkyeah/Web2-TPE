<?php
//modelo: acceso a BD; interacción directa con la tabla `ins_categ`

class CategModel {

    /**
     * --------------------------------------------
     * ¿Cómo hago para no tener que copiar y pegar todo este código?
     * (private $db y la función del constructor)
     * --------------------------------------------
     */

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
     * Retorna todas las categorías en la tabla
     */
    public function getAllCategory() {
        $query = $this->db->prepare('SELECT * FROM `ins_categ` ORDER BY `id_categ`');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Agrega una categoría nueva
     */
    public function saveCateg($name) {
        $query = $this->db->prepare('INSERT INTO `ins_categ` (`categ_name`) VALUES ?');
        return ($query->execute([$name]));
    }

    public function deleteCateg($id) {
        $query = $this->db->prepare('DELETE FROM `ins_categ` WHERE `id_categ` = ?');
        return ($query->execute([$id]));
    }

}

?>