<?php
// controlador: coordinador entre vista y modelo

// TODO: Llamar al modelo de categorías para traer los nombres de la(s) categoría(s)

require_once('models/InsModel.php');
require_once('views/InsView.php');
require_once('models/CategModel.php');

class InsController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new InsModel();
        $this->view = new InsView();
    }

    /**
     * Trae un arreglo con los instrumentos pertenecientes a una categoría en particular
     * pasada por parámetro.
     * Luego lo muestra por pantalla.
     */
    public function showCategoryInstruments($idCateg,$category) {
        $instruments = $this->model->getCategoryIns($idCateg);
        $this->view->viewCategIns($instruments,$category);
    }

    /**
     * Trae un arreglo con todos los instrumentos en la tabla `instruments`.
     * Luego lo muestra por pantalla.
     */

    public function showAllInstruments() {
        $instruments = $this->model->getAllIns();
        $this->view->viewAllIns($instruments);
    }

    /**
     * Trae un objeto correspondiente a un instrumento a través de su ID pasado por parámetro.
     * Luego lo muestra por pantalla.
     */

    public function showInstrumentDetail($id) {
        $instrument = $this->model->getIns($id);
        $this->view->viewInsDetail($instrument);
    }

    /**
     * Agrega un instrumento incluyendo su nombre, precio, detalles y categoría.
     * Probar cómo funciona éste antes de duplicarlo para hacer un sistema de creación de categorías.
     */
    public function addInstrument() {
        $name = $_POST['insName'];
        $price = $_POST['price'];
        $details = $_POST['insDetails'];
        $insCateg = $_POST['insCateg'];

        if(empty($name) || empty($price) || empty($insCateg)) {
            $this->view->showError("Faltan datos obligatorios.","Revise el nombre, precio y categoría.");
            die();
        }

        $success = $this->model->saveIns($name, $price, $details, $insCateg);
        if($success) {
            header('Location: '. BASE_URL .'instruments');
        }
        else {
            $this->view->showError("No se pudo realizar la consulta.","Puede que falten datos o sean inválidos.");
        }
    }

    /**
     * Actualiza un instrumento de la tabla buscándolo con su ID pasado por parámetro.
     */
    public function updateInstrument($id) {
        
        $name = $_POST['insName'];
        $price = $_POST['price'];
        $details = $_POST['insDetails'];
        $insCateg = $_POST['insCateg'];

        if(empty($name) || empty($price) || empty($insCateg)) {
            $this->view->showError("Faltan datos obligatorios.","Revise el nombre, precio y categoría.");
            die();
        }
        
        if(empty($details)) {
            $details = "";
        }

        $success = $this->model->updateIns($name, $details, $id);
        if($success) {
            header('Location: '. BASE_URL ."categories");
        }
        else {
            $this->view->showError("No se pudo realizar la consulta.","Puede que falten datos o sean inválidos.");
        }
        
    }

}

?>