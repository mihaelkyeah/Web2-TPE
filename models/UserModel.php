<?php
// modelo: acceso a BD; interacción con la tabla `user`
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

    /**
     * @return string
     * Devuelve sólo la columna `username`
     * de la fila en la tabla de usuarios con el id especificado
     */
    public function getUsernameByID($userID) {
        $query = $this->getDb()->prepare('SELECT `username` FROM `user` WHERE `id` = ?');
        $query->execute([$userID]);
        return $query->fetchColumn(); // Devuelve sólo la información en la columna `username`
    }

    /**
     * @return array
     * Devuelve un arreglo de objetos con todos los usuarios de la tabla `user`.
     * Selecciona a todos los usuarios MENOS al que está logueado y al administrador principal
     */
    public function getUserList($currentID) {
        $query = $this->getDb()->prepare('SELECT `id`, `username`, `admin` FROM `user` WHERE (`id` != ?) AND (`owner` != ?) ORDER BY `id`');
        // TODO: Optimizar y refactorizar método para traer lista de usuarios
        $ownerTrue = 1;
        $query->execute([$currentID,$ownerTrue]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return boolean
     * Registra un usuario nuevo a la BD
     */
    public function saveUser($username, $pass) {
        $query = $this->getDb()->prepare('INSERT INTO `user` (`username`, `pass`) VALUES (?, ?)');
        return $query->execute([$username,$pass]);
    }

    /**
     * @return boolean
     * @param 1|0 $adminTrueFalse
     * @param int $userID
     * Agrega o quita el rango de administrador a un usuario
     */
    public function updateUserAdmin($adminTrueFalse, $userID) {
        $query = $this->getDb()->prepare('UPDATE `user` SET `admin` = ? WHERE `id` = ?');
        return $query->execute([$adminTrueFalse,$userID]);
    }

    /**
     * @return boolean
     * Borra un usuario de la tabla `user` por ID
     */
    public function deleteUser($userID) {
        $query = $this->getDB()->prepare('DELETE FROM `user` WHERE `id` = ?');
        return $query->execute([$userID]);
    }

}

?>