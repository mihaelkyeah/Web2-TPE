<?php
//modelo: acceso a BD; interacción directa con la tabla `ins_category`

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
            $this->db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
        }
        catch (Exception $e) {
            echo(var_dump($e));
        }
    }

    /**
     * @return object
     * Retorna una categoría por ID
     */
    public function getCateg($id) {
        $query = $this->db->prepare('SELECT * FROM `ins_category` WHERE `id_categ` = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @return array
     * Retorna todas las categorías en la tabla
     */
    public function getAllCateg() {
        $query = $this->db->prepare('SELECT * FROM `ins_category` ORDER BY `id_categ`');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Agrega una categoría nueva
     */
    public function saveCateg($name,$details) {
        $query = $this->db->prepare('INSERT INTO `ins_category` (`categ_name`, `categ_desc`) VALUES (?, ?)');
        return ($query->execute([$name,$details]));
    }

    /**
     * Actualiza una categoría por id
     */
    public function updateCateg($name,$details,$id) {
        $query = $this->db->prepare('UPDATE `ins_category` SET `categ_name` = ?, `categ_desc` = ? WHERE `ins_category`.`id_categ` = ?');
        return ($query->execute([$name,$details,$id]));
    }

    /**
     * Borra una categoría por id
     */
    public function deleteCateg($id) {
        $query = $this->db->prepare('DELETE FROM `ins_category` WHERE `id_categ` = ?');
        return ($query->execute([$id]));
    }

}

?>