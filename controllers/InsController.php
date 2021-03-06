<?php
// controlador: coordinador entre vista y modelo (instrumentos)

require_once('controllers/Controller.php');
require_once('models/InsModel.php');
require_once('models/InsImgModel.php');
require_once('models/CategModel.php');
require_once('views/InsView.php');

class InsController extends Controller {

    private $model;
    private $view;
    private $imgModel;

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
        $this->imgModel = new InsImgModel();
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
        $instrument = $this->model->getIns($id);
        $insImages = $this->imgModel->getImgAlbum($id);
        $categIndex = array_search(($instrument->id_categ_fk), array_column($this->categoryArray,'id'));
        $this->view->viewInsDetail($instrument,$this->categoryArray,$categIndex,$insImages,$this->isadmin);
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
        $success = $this->model->saveIns($name, $price, $details, $insCateg);

        if($success) {
            header('Location: '. BASE_URL .'instruments');
        }
        else {
            $this->view->showError("The query could not be resolved","Values might be missing or invalid.");
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
        $success = $this->model->updateIns($name, $price, $details, $insCateg, $id);
        
        if($success) {
            // Redirección específica para poder ver de manera instantánea los cambios realizados.
            header('Location:'. BASE_URL .'details/instrument/'.$id);
        }
        else {
            $this->view->showError("The query could not be resolved","Values might be missing or invalid.");
        }
        
    }

    public function addImgIns($insID) {

        if($this->ifImage()) {
            $success = $this->imgModel->saveInsImg($insID);
        }
        if($success) {
            header('Location:'. BASE_URL .'details/instrument/'.$insID);
        }
        else {
            $this->showError('Error uploading image','The image could not be added to the database.');
        }

    }

    public function removeImgIns($insID,$imgID) {

        $imgPath = $this->getImgPathDB($imgID);
        if($imgPath != null) {

            if(file_exists($imgPath))
                unlink($imgPath);
            $success = $this->imgModel->deleteImg($imgID);

            if ($success) {
                header('Location:'. BASE_URL .'details/instrument/'.$insID);
            }
            else {
                $this->showError('The query could not be resolved','Image path could not be removed from the database.');
            }

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

    // Devuelve la ruta de la imagen por medio de su ID
    private function getImgPathDB($imgID) {
        return $this->imgModel->getImgPath($imgID);
    }

    // Borra una imagen del servidor habiendo recibido su ruta desde la DB,
    // y luego indica a la DB que ya no esté vinculada a esa imagen

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