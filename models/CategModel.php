<?php
//modelo: acceso a BD; interacción directa con la tabla `ins_category`
require_once('models/Model.php');

class CategModel extends Model {

    /**
     * @return object
     * Retorna una categoría por ID
     */
    public function getCateg($id) {
        $query = $this->getDb()->prepare('SELECT * FROM `ins_category` WHERE `id_categ` = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @return array
     * Retorna todas las categorías en la tabla
     */
    public function getAllCateg() {
        $query = $this->getDb()->prepare('SELECT * FROM `ins_category` ORDER BY `id_categ`');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Agrega una categoría nueva
    public function saveCateg($name,$details) {
        $query = $this->getDb()->prepare('INSERT INTO `ins_category` (`categ_name`, `categ_desc`) VALUES (?, ?)');
        return ($query->execute([$name,$details]));
    }

    // Actualiza una categoría por ID
    public function updateCateg($name,$details,$id) {
        $query = $this->getDb()->prepare('UPDATE `ins_category` SET `categ_name` = ?, `categ_desc` = ? WHERE `ins_category`.`id_categ` = ?');
        return ($query->execute([$name,$details,$id]));
    }

    // Borra una categoría por ID
    public function deleteCateg($id) {
        $query = $this->getDb()->prepare('DELETE FROM `ins_category` WHERE `id_categ` = ?');
        return ($query->execute([$id]));
    }

}

?>