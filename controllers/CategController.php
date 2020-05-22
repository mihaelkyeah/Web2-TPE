<?php
// controlador: coordinador entre vista y modelo

include_once('models/CategModel.php');
include_once('views/CategView.php');

class CategController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new CategModel();
        $this->view = new CategView();
    }

    public function showCategoryDetail($id) {
        $category = $this->model->getCateg($id);
        $this->view->viewCategDetail($category);
    }

    public function showAllCategory() {
        $categories = $this->model->getAllCateg();
        $this->view->viewCategories($categories);
    }

    /**
     * Agrega una categoría incluyendo su nombre y descripción.
     */
    public function addCategory() {
        $name = $_POST['categName'];
        $details = $_POST['categDetails'];

        if(empty($name)) {
            $this->view->showError("Faltan datos obligatorios.","Revise el nombre de la categoría.");
            die();
        }
        // ¿esto sería necesario?
        if(empty($details)) {
            $details = "";
        }

        $success = $this->model->saveCateg($name, $details);
        if($success) {
            header('Location: '. BASE_URL ."categories");
        }
        else {
            $this->view->showError("No se pudo realizar la consulta.","Puede que falten datos o sean inválidos.");
        }
    }

    /**
     * @return array
     * Trae todas las categorías para que el router las envíe a las vistas de instrumentos
     * individuales o por categoría.
     */
    public function getCategoryArray() {
        $categories = $this->model->getAllCateg();
        return $categories;
    }

    /**
     * Actualiza una categoría por ID.
     */

    public function updateCategory($id) {
        
        $name = $_POST['categName'];
        $details = $_POST['categDetails'];

        if(empty($name)) {
            $this->view->showError("Faltan datos obligatorios.","Revise el nombre de la categoría.");
            die();
        }

        if(empty($details)) {
            $details = "";
        }

        $success = $this->model->updateCateg($name, $details, $id);
        if($success) {
            header('Location: '. BASE_URL ."categories");
        }
        else {
            $this->view->showError("No se pudo realizar la consulta.","Puede que falten datos o sean inválidos.");
        }
        
    }

}

?>