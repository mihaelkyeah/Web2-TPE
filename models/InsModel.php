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
     * @return string
     * Copia la imagen subida mediante el formulario para crear una instancia única.
     * Desc. original:
     * Mueve el archivo subido y le asigna un nombre; retorna el nombre creado.
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

    /**
     * Agrega un instrumento nuevo (con o sin imagen)
     */
    public function saveIns($name, $price, $details, $category, $image = null) {
        $query = $this->getDb()->prepare('INSERT INTO `instrument` (`name`, `price`, `details`, `id_categ_fk`, `image`) VALUES (?, ?, ?, ?, ?)');
        return $query->execute([$name,$price,$details,$category,$image]);
    }

    /**
     * Si una imagen fue subida, mediante el formulario de entrada HTML,
     * llama al método que mueve el archivo y le asigna un nuevo nombre único
     * y luego inserta el instrumento en la BD con una imagen no nula.
     */
    public function saveInsImg($name, $price, $details, $category) {
        $img_finalName = $this->copyImage();
        $success = $this->saveIns($name, $price, $details, $category, $img_finalName);
        return $success;
    }

    /**
     * Actualiza un instrumento por id
     */
    public function updateIns($name, $price, $details, $category, $id, $image = null) {
        $query = $this->getDb()->prepare('UPDATE `instrument` SET `name` = ?, `price` = ?, `details` = ?, `id_categ_fk` = ?, `image` = ? WHERE `instrument`.`id` = ?');
        return $query->execute([$name,$price,$details,$category,$image,$id]);
    }

    /**
     * Actualiza un instrumento por id sobreescribiendo su imagen
     */
    public function updateInsImg($name, $price, $details, $category, $id) {
        $img_finalName = $this->copyImage();
        $success = $this->updateIns($name, $price, $details, $category, $id, $img_finalName);
        return $success;
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