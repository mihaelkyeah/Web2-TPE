<?php
// controlador: coordinador entre vista y modelo

include_once('models/InsModel.php');
include_once('views/InsView.php');

class Controller {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new InsModel();
        $this->view = new InsView();
    }

    /**
     * @return array
     * Reutilizo la misma función para mostrar todos los instrumentos o los instrumentos
     * de una determinada categoría, dependiendo de qué recibe por parámetro.
     * Lo que devuelve es el arreglo con los instrumentos que va a mostrar
     * y se lo pasa directamente a la función showIns dentro de InsView.php.
     */
    public function showIns($idCateg) {
        if($idCateg == 0) {
            $instruments = $this->model->getAllIns();
        }
        else {
            $instruments = $this->model->getCategoryIns($idCateg);
        }
        $this->view = showIns($instruments);
    }

    /**
     * Agrega un instrumento incluyendo su nombre, precio, detalles y categoría.
     * Probar cómo funciona éste antes de duplicarlo para hacer un sistema de creación de categorías.
     */
    public function addIns() {
        $insName = $_POST['insName'];
        $price = $_POST['price'];
        $details = $_POST['details'];
        $insCateg = $_POST['insCateg'];

        if(empty($insName) || empty($price) || empty($insCateg)) {
            $this->view->showError("Faltan datos obligatorios.","Revise el nombre, precio y categoría.");
            die();
        }

        $success = $this->model->saveIns($insName, $price, $details, $insCateg);
        if($success) {
            header('Location: '. BASE_URL .'instruments');
        }
        else {
            $this->view->showError("No se pudo realizar la consulta.","Puede que falten datos o sean inválidos.");
        }
    }

}

?>