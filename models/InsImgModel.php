<?php
//modelo: acceso a BD; interacción con la tabla `ins_image`
require_once('models/Model.php');

class InsImgModel extends Model {

    /**
     * @return array
     * Devuelve un arreglo con todas las imágenes asociadas a un instrumento.
     * Específicamente, trae las columnas `id` (de la imgaen) y `image` (ruta de la imagen en el servidor)
     */
    public function getImgAlbum($insID) {
        $query = $this->getDb()->prepare('SELECT `id`, `image` FROM `ins_image` WHERE `ins_album_fk` = ?');
        $query->execute([$insID]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return boolean
     * Si una imagen fue subida, mediante el formulario de entrada HTML,
     * llama al método que mueve el archivo y le asigna un nuevo nombre único
     * y luego inserta la ruta de la imagen en el servidor vinculándola al instrumento
     * cuyo ID fue pasado por parámetro
     */
    public function saveInsImg($insID) {
        $img_finalName = $this->copyImage();
        $query = $this->getDb()->prepare('INSERT INTO `ins_image` (`image`, `ins_album_fk`) VALUES (?, ?)');
        return $query->execute([$img_finalName,$insID]);
    }

    /**
     * @return string
     * Devuelve la ruta de una imagen referenciada en la columna `image` de la tabla `ins_image`
     * para que pueda ser borrada del servidor por el controlador
     */
    public function getImgPath($imgID) {
        $query = $this->getDb()->prepare('SELECT `image` FROM `ins_image` WHERE `id` = ?');
        $query->execute([$imgID]);
        return $query->fetchColumn();
    }

    /**
     * @return boolean
     * Borra la fila de la tabla `ins_image` asociada a una imagen en el servidor
     */
    public function deleteImg($imgID) {
        $query = $this->getDb()->prepare('DELETE FROM `ins_image` WHERE `id` = ?');
        return $query->execute([$imgID]);
    }

}
?>