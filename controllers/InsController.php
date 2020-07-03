<?php
// controlador: coordinador entre vista y modelo (instrumentos)

require_once('controllers/Controller.php');
require_once('models/InsModel.php');
require_once('models/CategModel.php');
require_once('views/InsView.php');

class InsController extends Controller {

    private $model;
    private $view;

    /**
     * Inicialización del modelo de categorías y el arreglo de categorías:
     * el modelo de categorías va a ser necesario para traer un arreglo de objetos
     * con todas las categorías que van a hacer falta para asignar una categoría
     * a un instrumento nuevo en su creación, o para modificar la de un instrumento
     * existente.
     */
    private $catModel;
    public $categoryArray;

    private function initCategArray() {
        $this->catModel = new CategModel();
        $categArray = $this->catModel->getAllCateg();
        return $categArray;
    }

    public function __construct() {
        parent::__construct();
        $this->categoryArray = $this->initCategArray();
        $this->model = new InsModel();
        $this->view = new InsView($this->isadmin);
    }

    /**
     * Trae un arreglo con los instrumentos pertenecientes a una categoría en particular
     * pasada por parámetro.
     * Luego lo muestra por pantalla.
     */
    public function showCategoryInstruments($idCateg) {
        $categIndex = array_search($idCateg, array_column($this->categoryArray,'id'));

        $category = $this->categoryArray[$categIndex]->name;
        $instruments = $this->model->getCategoryIns($idCateg);

        $this->view->viewCategIns($instruments,$category,$this->isadmin);
    }

    /**
     * Trae un arreglo con todos los instrumentos en la tabla `instruments`.
     * Luego lo muestra por pantalla.
     */
    public function showAllInstruments() {
        $instruments = $this->model->getAllIns();
        $this->view->viewAllIns($instruments,$this->isadmin);
    }

    /**
     * Trae un objeto correspondiente a un instrumento a través de su ID pasado por parámetro.
     * Luego lo muestra por pantalla.
     */
    public function showInstrumentDetail($id) {
        // TODO: Implementar verificación de admin para el form desde acá
        $instrument = $this->model->getIns($id);
        $categIndex = array_search(($instrument->id_categ_fk), array_column($this->categoryArray,'id'));
        $this->view->viewInsDetail($instrument,$this->categoryArray,$categIndex,$this->isadmin);
    }

    // Muestra el formulario para crear un instrumento desde cero
    public function showFormInstrument() {
        AuthHelper::getPermission();
        $this->view->showFormIns($this->categoryArray);
    }

    /**
     * Agrega un instrumento incluyendo su nombre, precio, detalles y categoría.
     * Probar cómo funciona éste antes de duplicarlo para hacer un sistema de creación de categorías.
     */
    public function addInstrument() {
        $name = $_POST['insName'];
        $price = floatval($_POST['price']);
        $details = $_POST['insDetails'];
        $insCateg = intval($_POST['insCateg']);

        if(empty($name) || empty($price) || empty($insCateg)) {
            $this->view->showError("Obligatory values missing","Check the name, price and category fields.");
            die;
        }

        AuthHelper::getLoggedIn();

        if($this->ifImage()) {
            $success = $this->model->saveInsImg($name, $price, $details, $insCateg);
        }
        else {
            $success = $this->model->saveIns($name, $price, $details, $insCateg);
        }

        if($success) {
            header('Location: '. BASE_URL .'instruments');
        }
        else {
            $this->view->showError("The query could not be resolved","Values might be missing or invalid.");
            var_dump($name, $price, $details, $insCateg);
            die;
        }
    }

    // Actualiza un instrumento por ID
    public function updateInstrument($id) {
        
        $name = $_POST['insName'];
        $price = floatval($_POST['price']);
        $details = $_POST['insDetails'];
        $insCateg = intval($_POST['insCateg']);

        if(empty($name) || empty($price) || empty($insCateg)) {
            $this->view->showError("Obligatory values missing","Check the name, price and category fields.");
            die();
        }

        AuthHelper::getLoggedIn();

        if($this->ifImage()) {
            $success = $this->model->updateInsImg($name, $price, $details, $insCateg, $id);
        }
        else {
            $success = $this->model->updateIns($name, $price, $details, $insCateg, $id);
        }
        
        if($success) {
            header('Location: '. BASE_URL .'instruments');
        }
        else {
            $this->view->showError("The query could not be resolved","Values might be missing or invalid.");
        }
        
    }

    // Verifica si un archivo válido de imagen fue subido mediante el formulario HTML
    // (para creación o edición de entrada)
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

    // Borra un instrumento por ID
    public function deleteInstrument($id) {
        
        AuthHelper::getLoggedIn();
        $success = $this->model->deleteIns($id);
        if($success) {
            header('Location:'. BASE_URL .'instruments');
        }
        else {  // No sé si esto sería necesario; que muestre el error si no se puede borrar un instrumento.
            $this->view->showError("The instrument could not be removed. There was an unhandled error.",var_dump($success));
        }

    }

}

?>