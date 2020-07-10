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
    public function saveCateg($name,$details,$image=null) {
        $query = $this->getDb()->prepare('INSERT INTO `category` (`name`, `details`, `image`) VALUES (?, ?, ?)');
        return ($query->execute([$name,$details,$image]));
    }

    /**
     * @return boolean
     * Si recibió una imagen en el formulario de agregar categoría,
     * obtiene la ruta de la imagen copiada al servidor y guarda una categoría
     * enviándole la ruta de esa imagen para ser insertada en la columna `image`.
     */
    public function saveCategImg($name,$details) {
        $img_finalname = $this->copyImage();
        $success = $this->saveCateg($name,$details,$img_finalname);
        return $success;
    }

    /**
     * @return boolean
     * Actualiza una categoría por ID, con o sin imagen dependiendo de si
     * recibe una ruta de imagen o no
     */
    public function updateCateg($name,$details,$id,$image=null) {
        if(isset($image)) {
            $query = $this->getDb()->prepare('UPDATE `category` SET `name` = ?, `details` = ?, `image` = ? WHERE `category`.`id` = ?');
            return ($query->execute([$name,$details,$image,$id]));
        }
        else {
            $query = $this->getDb()->prepare('UPDATE `category` SET `name` = ?, `details` = ? WHERE `category`.`id` = ?');
            return ($query->execute([$name,$details,$id]));
        }
    }

    /**
     * @return boolean
     * Llama al método updateCateg pasando como parámetro de imagen
     * la ruta obtenida de la imagen que fue copiada al servidor
     */
    public function updateCategImg($name,$details,$id) {
        $img_finalname = $this->copyImage();
        $success = $this->updateCateg($name,$details,$id,$img_finalname);
        return $success;
    }

    /**
     * @return string
     * Devuelve la ruta de la imagen asociada a una categoría por su ID (de la categoría)
     */
    public function getImgPath($id) {
        $query = $this->getDb()->prepare('SELECT `image` FROM `category` WHERE `id` = ?');
        $query->execute([$id]);
        return $query->fetchColumn();
    }

    /**
     * @return boolean
     * Una vez que el controlador tiene la ruta de la imagen y puede borrar el archivo del servidor,
     * llama a este método para que actualice la fila de la tabla `category` con el ID pasado por parámetro
     * y setee la columna `image` a NULL.
     */
    public function removeImg($id) {
        $query = $this->getDb()->prepare('UPDATE `category` SET `image` = ? WHERE `id` = ?');
        $removeImgDB = null;
        return $query->execute([$removeImgDB,$id]);
    }

    // Borra una categoría por ID
    public function deleteCateg($id) {
        $query = $this->getDb()->prepare('DELETE FROM `category` WHERE `id` = ?');
        return ($query->execute([$id]));
    }

}

?>