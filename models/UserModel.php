<?php
// modelo: acceso a BD; interacción directa con la tabla `user`
require_once('models/Model.php');

class UserModel extends Model {

    /**
     * @return object
     * Devuelve un usuario de la base de datos
     * cuyo atributo username coincida con el del parámetro
     */
    public function getUserByUsername($username) {
        $query = $this->getDb()->prepare('SELECT * FROM `user` WHERE username = ?');
        $query->execute([$username]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

}

?>