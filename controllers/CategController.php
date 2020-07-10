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
        if($this->ifImage()) {
            $success = $this->model->saveCategImg($name, $details);
        } else {
            $success = $this->model->saveCateg($name, $details);
        }

        if($success) {
            header('Location: '. BASE_URL .'categories');
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
        if($this->ifImage()) {
            // Obtiene la ruta de imagen existente en la BD y la borra del servidor
            $this->deleteImgServer($id);
            // Luego invoca al método para copiar la imagen cargada por el form al servidor
            // y subir su ruta a la BD
            $success = $this->model->updateCategImg($name, $details, $id);
        } else {
            $success = $this->model->updateCateg($name, $details, $id);
        }
        if($success) {
            header('Location:'. BASE_URL .'details/category/'.$id);
        }
        else {
            $this->view->showError("The query could not be resolved","Values might be missing or invalid.");
        }
        
    }

    private function ifImage() {
        if (($_FILES['insImg']['type'] == "image/jpg") ||
            ($_FILES['insImg']['type'] == "image/jpeg") ||
            ($_FILES['insImg']['type'] == "image/png")) {
            return true;
        }
        else {
            return false;
        }
    }

    // Devuelve la ruta de la imagen asociada a una categoría en la BD
    private function getImgPathDB($id) {
        return $this->model->getImgPath($id);
    }

    // Borra una imagen del servidor
    // (ya sea para cambiarla por otra en la BD o para borrarla en el servidor y en la BD)
    private function deleteImgServer($id) {
        $imgPath = $this->getImgPathDB($id);
        if(($imgPath != null) && (file_exists($imgPath))) {
            unlink($imgPath);
            return true;
        }
        else {
            return false;
        }
    }

    // Borra una imagen del servidor habiendo recibido su ruta desde la DB,
    // y luego indica a la DB que ya no esté vinculada a esa imagen
    public function removeImgCateg($id) {

        // Si tiene éxito en borrar la imagen del servidor,
        // llama a la función del modelo para borrar la entrada de la BD
        if(deleteImgServer($id)) {
            $success = $this->model->removeImg($id);
            if ($success) {
                header('Location:'. BASE_URL .'details/category/'.$id);
            }
            else {
                $this->showError('The query could not be resolved','Image path could not be removed from the database.');
            }
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