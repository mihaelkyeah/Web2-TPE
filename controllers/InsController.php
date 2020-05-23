<?php
// controlador: coordinador entre vista y modelo (instrumentos)

require_once('models/InsModel.php');
require_once('views/InsView.php');

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
    public function showInstrumentDetail($id,$categoryArray) {
        $instrument = $this->model->getIns($id);
        $categIndex = array_search(($instrument->id_categ_fk), array_column($categoryArray,'id_categ'));
        $this->view->viewInsDetail($instrument,$categoryArray,$categIndex);
    }

    // Muestra el formulario para crear un instrumento desde cero
    public function showFormInstrument($categoryArray) {
        $this->view->showFormIns($categoryArray);
    }

    /**
     * Agrega un instrumento incluyendo su nombre, precio, detalles y categoría.
     * Probar cómo funciona éste antes de duplicarlo para hacer un sistema de creación de categorías.
     */
    public function addInstrument() {
        $name = $_POST['insName'];
        $price = $_POST['price'];
        $details = $_POST['insDesc'];
        $insCateg = $_POST['insCateg'];

        if(empty($name) || empty($price) || empty($insCateg)) {
            $this->view->showError("Obligatory values missing","Check the name, price and category fields.");
            die;
        }

        $success = $this->model->saveIns($name, $price, $details, $insCateg);
        if($success) {
            header('Location: '. BASE_URL .'instruments');
        }
        else {
            $this->view->showError("The query could not be resolved","Values might be missing or invalid.");
            die;
        }
    }

    // Actualiza un instrumento por ID
    public function updateInstrument($id) {
        
        $name = $_POST['insName'];
        $price = floatval($_POST['price']);
        $details = $_POST['insDesc'];
        $insCateg = intval($_POST['insCateg']);

        if(empty($name) || empty($price) || empty($insCateg)) {
            $this->view->showError("Obligatory values missing","Check the name, price and category fields.");
            die();
        }
        
        if(empty($details)) {
            $details = "";
        }

        $success = $this->model->updateIns($name, $price, $details, $insCateg, $id);
        if($success) {
            header('Location: '. BASE_URL .'instruments');
        }
        else {
            $this->view->showError("The query could not be resolved","Values might be missing or invalid.");
        }
        
    }

    // Borra un instrumento por ID
    public function deleteInstrument($id) {
        $this->model->deleteIns($id);
        header('Location:'. BASE_URL .'instruments');
    }

}

?>