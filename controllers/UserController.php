<?php
// controlador: coordinador entre vista y modelo (usuarios)

require_once('controllers/Controller.php');
require_once('views/UserView.php');
require_once('models/UserModel.php');

class UserController extends Controller {

    private $model;
    private $view;

    public function __construct() {
        parent::__construct();
        $this->view = new UserView($this->isadmin);
        $this->model = new UserModel();
    }

    // Muestra la principal
    public function showHome() {
        $this->view->viewHome();
    }

    /**
     * ===== CONTROLES DE SESIÓN =====
     */

    // Muestra el formulario de inicio de sesión
    public function showLogin() {
        $this->view->viewLogin();
    }

    // Verificación del usuario ingresado comparándolo con un usuario de la base de datos
    public function verify() {
        if(!empty($_POST['username']) && !empty($_POST['password'])) {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $userDB = $this->model->getUserByUsername($user);

            if(!empty($userDB) && password_verify($pass, $userDB->pass)) {
                AuthHelper::login($userDB);
                header('Location: '. BASE_URL .'home');
                // $msg = ("Welcome, ".$userDB->username); (*)
                // $this->view->viewHome($msg); (*)
            }
            else {
                $this->view->viewLogin("Incorrect username or password.");
                die;
            }
        }
        else {
            $this->view->viewLogin("Login credentials missing.");
            die;
        }
    }

    // Cierre de sesión
    public function logout() {
        AuthHelper::logout();
        // $this->view->viewHome("You have logged out."); (*)
        header('Location: '. BASE_URL .'home');
    }

    /**
     * ===== ADMINISTRACIÓN DE USUARIOS =====
     */

    // Muestra el panel de control del usuario actual
    public function showProfile() {
        AuthHelper::getLoggedIn();
        $this->view->viewProfile(($_SESSION['ID USER']), $this->isadmin);
    }

    // Muestra la lista de usuarios (a un administrador)
    public function showUsers() {
        AuthHelper::getPermission();
        $users = $this->model->getUsers();
        $this->view->viewUserList($users);
    }

    // Muestra a un usuario nuevo el formulario para crear su cuenta
    public function showSignUp() {
        $this->view->viewSignUpForm();
    }
    
    // Crea una cuenta a partir de un formulario de cuenta nueva rellenado por un usuario nuevo
    public function createUser() {
        $newUsername = $_POST['username'];
        $newPass = $_POST['password'];
        $newPassHash = password_hash($newPass, PASSWORD_DEFAULT);

        $success = $this->model->saveUser($newUsername, $newPassHash);
        if($success) {
            header('Location:'.BASE_URL.'login');
        }
        else {
            $this->view->showError('Error adding new user to database','The registration process could not be completed.');
        }
    }

    // Agrega o quita privilegios de administrador a un usuario,
    // dependiendo de si $adminTrueFalse es igual a 1 o a 0.
    public function addRemoveAdmin($adminTrueFalse, $userID) {
        AuthHelper::getPermission();
        $username = $this->model->getUsernameByID($userID);
        $success = $this->model->updateUserAdmin($adminTrueFalse, $userID);
        if($success)  {
            header('Location:'.BASE_URL.'userlist');
        }
        else {
            $this->view->showError("The query could not be resolved","Admin privileges could not be added or removed from the user.");
        }
        
    }

}

/**
 * (*): Quería mostrar los textos "Welcome, [nombre de usuario]" cuando se inicia la sesión,
 * y "You have logged out." cuando se cierra, ambos mostrados en el home.
 */

?>