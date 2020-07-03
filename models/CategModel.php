<?php
//modelo: acceso a BD; interacción con la tabla `category`
require_once('models/Model.php');

class CategModel extends Model {

    /**
     * @return object
     * Retorna una categoría por ID
     */
    public function getCateg($id) {
        $query = $this->getDb()->prepare('SELECT * FROM `category` WHERE `id` = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @return array
     * Retorna todas las categorías en la tabla
     */
    public function getAllCateg() {
        $query = $this->getDb()->prepare('SELECT * FROM `category` ORDER BY `id`');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Agrega una categoría nueva
    public function saveCateg($name,$details) {
        $query = $this->getDb()->prepare('INSERT INTO `category` (`name`, `details`) VALUES (?, ?)');
        return ($query->execute([$name,$details]));
    }

    // Actualiza una categoría por ID
    public function updateCateg($name,$details,$id) {
        $query = $this->getDb()->prepare('UPDATE `category` SET `name` = ?, `details` = ? WHERE `category`.`id` = ?');
        return ($query->execute([$name,$details,$id]));
    }

    // Borra una categoría por ID
    public function deleteCateg($id) {
        $query = $this->getDb()->prepare('DELETE FROM `category` WHERE `id` = ?');
        return ($query->execute([$id]));
    }

}

?>