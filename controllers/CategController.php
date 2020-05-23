<?php
// controlador: coordinador entre vista y modelo (categorías)

include_once('models/CategModel.php');
include_once('views/CategView.php');

class CategController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new CategModel();
        $this->view = new CategView();
    }

    // Muestra todas las categorías
    public function showAllCategory() {
        $categories = $this->model->getAllCateg();
        $this->view->viewCategories($categories);
    }

    // Muestra una categoría por ID
    public function showCategoryDetail($id) {
        $category = $this->model->getCateg($id);
        $this->view->viewCategDetail($category);
    }

    // Muestra el formulario para agregar una categoría nueva
    public function showFormCategory() {
        $this->view->showFormCateg();
    }

    /**
     * Agrega una categoría incluyendo su nombre y descripción
     */
    public function addCategory() {
        $name = $_POST['categName'];
        $details = $_POST['categDetails'];

        if(empty($name)) {
            $this->view->showError("Obligatory values missing","Check the category name.");
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
            $this->view->showError("The query could not be resolved","Values might be missing or invalid.");
        }
    }

    /**
     * @return array
     * Trae todas las categorías para que el router las envíe a las vistas de instrumentos
     * individuales o por categoría
     */
    public function getCategoryArray() {
        $categories = $this->model->getAllCateg();
        return $categories;
    }

    // Actualiza una categoría por ID
    public function updateCategory($id) {
        
        $name = $_POST['categName'];
        $details = $_POST['categDetails'];

        if(empty($name)) {
            $this->view->showError("Obligatory values missing","Check the category name.");
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
            $this->view->showError("The query could not be resolved","Values might be missing or invalid.");
        }
        
    }

    // Borra una categoría por ID
    public function deleteCategory($id) {
        $success = $this->model->deleteCateg($id);
        if($success) {
            header('Location:'. BASE_URL .'categories');
        }
        else {
            $this->view->showError("This category could not be removed","Please verify no instruments are associated with it.");
        }
    }

}

?>