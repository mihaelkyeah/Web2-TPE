<?php
// controlador: coordinador entre vista y modelo (categorías)

require_once('controllers/Controller.php');
require_once('models/CategModel.php');
require_once('views/CategView.php');

class CategController extends Controller {

    private $model;
    private $view;

    public function __construct() {
        parent::__construct();
        $this->model = new CategModel();
        $this->view = new CategView($this->isadmin);
    }

    // Muestra todas las categorías
    public function showAllCategory() {
        $categories = $this->model->getAllCateg();
        $this->view->viewCategories($categories,$this->isadmin);
    }

    // Muestra una categoría por ID
    public function showCategoryDetail($id) {
        $category = $this->model->getCateg($id);
        $this->view->viewCategDetail($category,$this->isadmin);
    }

    // Muestra el formulario para agregar una categoría nueva
    public function showFormCategory() {
        AuthHelper::getPermission();
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

        AuthHelper::getLoggedIn();
        $success = $this->model->saveCateg($name, $details);
        if($success) {
            header('Location: '. BASE_URL ."categories");
        }
        else {
            $this->view->showError("The query could not be resolved","Values might be missing or invalid.");
        }
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

        AuthHelper::getLoggedIn();
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

        AuthHelper::getLoggedIn();
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