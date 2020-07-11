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
    public function saveUser($username, $pass, $questionType, $answer) {
        $query = $this->getDb()->prepare('INSERT INTO `user` (`username`, `pass`, `question_type`, `question_answer`) VALUES (?, ?, ?, ?)');
        return $query->execute([$username,$pass,$questionType,$answer]);
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
     * @return object
     * Devuelve un objeto con el id, la pregunta y la respuesta para verificar
     * la respuesta encriptada comparándola con la recibida por formulario.
     */
    public function getUserID_Q_A_byUsername($username) {
        $query = $this->getDb()->prepare('SELECT `id`, `question_type`, `question_answer` FROM `user` WHERE `username` = ?');
        $query->execute([$username]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @return boolean
     * Tras haber hecho las verificaciones necesarias en el controller,
     * procede a llamar a esta función y cambiar la contraseña por una nueva (ya encriptada)
     */
    public function updateUserPassword($pass, $userID) {
        $query = $this->getDb()->prepare('UPDATE `user` SET `pass` = ? WHERE `id` = ?');
        return $query->execute([$pass, $userID]);
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