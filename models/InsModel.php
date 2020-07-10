<?php
// modelo: acceso a BD; interacción con la tabla `instrument`
require_once('models/Model.php');

class InsModel extends Model {

    /**
     * @return object
     * Devuelve un instrumento por ID
     */
    public function getIns($id) {
        $query = $this->getDb()->prepare('SELECT * FROM `instrument` WHERE `id` = ?');
        $query->execute([$id]);
        // ^ forma alternativa de tipear $query->execute(array($catId));
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @return array
     * Devuelve todos los instrumentos de una determinada categoría
     */
    public function getCategoryIns($category) {
        $query = $this->getDb()->prepare('SELECT * FROM `instrument` WHERE `id_categ_fk` = ?');
        $query->execute([$category]);
        // ^ forma alternativa de tipear $query->execute(array($catId));
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return array
     * Retorna todos los instrumentos ordenados por categoría
     */
    public function getAllIns() {
        $query = $this->getDb()->prepare('SELECT * FROM `instrument` ORDER BY `id_categ_fk`');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Agrega un instrumento nuevo (con o sin imagen)
     */
    public function saveIns($name, $price, $details, $category) {
        $query = $this->getDb()->prepare('INSERT INTO `instrument` (`name`, `price`, `details`, `id_categ_fk`) VALUES (?, ?, ?, ?)');
        return $query->execute([$name,$price,$details,$category]);
    }


    /**
     * Actualiza un instrumento por id
     */
    public function updateIns($name, $price, $details, $category, $id) {
        $query = $this->getDb()->prepare('UPDATE `instrument` SET `name` = ?, `price` = ?, `details` = ?, `id_categ_fk` = ? WHERE `instrument`.`id` = ?');
        return $query->execute([$name,$price,$details,$category,$id]);
    }


    /**
     * Borra un instrumento por id
     */
    public function deleteIns($id) {
        $query = $this->getDb()->prepare('DELETE FROM `instrument` WHERE `id` = ?');
        return ($query->execute([$id]));
    }

}

?>