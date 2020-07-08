<?php
require_once('models/Model.php');

class CommentModel extends Model {

    /**
     * @return boolean
     * Guarda un comentario en la tabla `comment` de la BD
     * enviado por un usuario de id $id_user en la página de un instrumento de id $id_ins
     */
    public function saveComment($id_ins, $id_user, $content, $rating) {
        $query = $this->getDb()->prepare('INSERT INTO `comment` (`id_ins_fk`, `id_user_fk`, `content`, `rating`) VALUES (?, ?, ?, ?)');
        return $query->execute([$id_ins, $id_user, $content, $rating]);
    }

    /**
     * @return boolean
     * Borra un comentario de la BD
     */
    public function deleteComment($id) {
        $query = $this->getDb()->prepare('DELETE FROM `comment` WHERE `id` = ?');
        return $query->execute([$id]);
    }

    /**
     * @return object
     * Trae un comentario de la BD
     */
    public function getComment($id) {
        $query = $this->getDb()->prepare('SELECT * FROM `comment` WHERE `id` = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @return array
     * Trae un arreglo de comentarios de la tabla `comment`
     * y los respectivos nombres de usuario de la tabla `user`
     * que hayan sido publicados en la página de un instrumento de id $id_ins
     * vinculados por la clave foránea id_user_fk en la tabla `comment`
     */
    public function getInsComments($id_ins) {
        $query = $this->getDb()->prepare('SELECT `comment`.*, `user`.`username` FROM `comment`, `user` WHERE (`id_ins_fk` = ?) AND (`comment`.`id_user_fk` = `user`.`id`)');
        $query->execute([$id_ins]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}

?>