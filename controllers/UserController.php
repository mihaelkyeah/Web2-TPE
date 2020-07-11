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
        if(!AuthHelper::getLoggedStatus()) {
            $this->view->viewLogin();
        }
        else {
            header('Location: '. BASE_URL .'home?err=login');
        }
    }

    // Verificación del usuario ingresado comparándolo con un usuario de la base de datos
    public function verify() {
    
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $userDB = $this->model->getUserByUsername($user);

        if(!empty($userDB) && password_verify($pass, $userDB->pass)) {
            AuthHelper::login($userDB);
            header('Location: '. BASE_URL .'home?log=in');
            // $msg = ("Welcome, ".$userDB->username); (*)
            // $this->view->viewHome($msg); (*)
        }
        else {
            $this->view->viewLogin('Incorrect username or password.');
            die;
        }
        
    }

    // Cierre de sesión
    public function logout() {
        if(AuthHelper::getLoggedStatus()) {
            AuthHelper::logout();
            header('Location: '. BASE_URL .'home?log=out');
        }
        else {
            header('Location: '. BASE_URL .'home?err=logout');
        }
    }

    /**
     * ===== ADMINISTRACIÓN DE USUARIOS =====
     */

    // Trae el ID del usuario logueado actualmente
    private function getCurrentID() {
        return $_SESSION['ID USER'];
    }

    // Muestra el panel de control del usuario actual
    public function showProfile() {
        AuthHelper::getLoggedIn();
        $currentID = $this->getCurrentID();
        $this->view->viewProfile(($currentID), $this->isadmin);
    }

    // Muestra la lista de usuarios (a un administrador)
    public function showUsers() {
        AuthHelper::getPermission();
        $currentID = $this->getCurrentID();
        $users = $this->model->getUserList($currentID);
        $this->view->viewUserList($users);
    }

    // Muestra a un usuario nuevo el formulario para crear su cuenta
    public function showSignUp($error=null) {
        if(!AuthHelper::getLoggedStatus()) {
            $this->view->viewSignUpForm($error);
        }
        else {
            header('Location:'.BASE_URL.'home?err=signup');
        }
    }
    
    // Crea una cuenta a partir de un formulario de cuenta nueva rellenado por un usuario nuevo
    public function createUser() {

        $newUsername = $_POST['username'];
        $newPass = $_POST['password'];
        $passConfirm = $_POST['confirmPassword'];
        $questionType = $_POST['securityQuestion'];
        $securityAnswer = $_POST['securityAnswer'];
        
        if ($newPass != $passConfirm) {
            $this->view->viewSignUpForm('Passwords do not match.');
            die;
        }
        elseif(empty($questionType)) {
            $this->view->viewSignUpForm('Please select a question from the dropdown menu.');
            die;
        }

        else {

            $newPassHash = password_hash($newPass, PASSWORD_DEFAULT);
            $secAnswerHash = password_hash($securityAnswer, PASSWORD_DEFAULT);

            $success = $this->model->saveUser($newUsername, $newPassHash, $questionType, $secAnswerHash);
            if($success) {
                // header('Location:'.BASE_URL.'login');
                $this->verify();
            }
            else {
                $this->view->showError('Error adding new user to database','The registration process could not be completed.');
            }

        }

    }

    // Agrega o quita privilegios de administrador a un usuario,
    // dependiendo de si $adminTrueFalse es igual a 1 o a 0.
    public function addRemoveAdmin($adminTrueFalse, $userID) {
        AuthHelper::getPermission();
        $success = $this->model->updateUserAdmin($adminTrueFalse, $userID);
        if($success)  {
            header('Location:'.BASE_URL.'user/userlist');
        }
        else {
            $this->view->showError('The query could not be resolved','Admin privileges could not be added or removed from the user.');
        }
        
    }

    // Muestra el formulario para responder la pregunta de seguridad
    // antes de cambiar la contraseña de un usuario
    public function showSecurityQuestionPrompt() {
        $this->view->viewSecQuestionPrompt();
    }

    // Verifica la pregunta y respuesta de seguridad y procede a intentar
    // cambiar la contraseña del usuario
    public function verifySecurityQuestion() {
        $username = $_POST['username'];
        $questionType = $_POST['securityQuestion'];
        $answer = $_POST['securityAnswer'];

        $existingUser = $this->model->getUserID_Q_A_byUsername($username);

        if(isset($existingUser)) {
            $success = (($questionType == $existingUser->question_type) && (password_verify($answer, $existingUser->question_answer)));
            if($success) {
                $userID = ($existingUser->id);
                header('Location:'.BASE_URL.'user/recovery/step2/'.$userID);
            }
            else {
                $this->view->viewSecQuestionPrompt('Question or answer are incorrect. Try again.');
            }
        }
        else {
            $this->view->viewSecQuestionPrompt('There is no user with that username in our database. Try again.');
        }
    }

    // Muestra el formulario para reestablecer la contraseña del usuario
    public function showResetPassword($userID) {
        $username = $this->model->getUsernameByID($userID);
        $this->view->viewResetPasswordForm($username, $userID);
    }

    // Verifica que los dos campos de contraseña sean iguales y
    // procede a cambiar la contraseña del usuario
    public function resetPassword($userID) {
        $changePass = $_POST['newPassword'];
        $changePassConfirm = $_POST['confirmNewPassword'];

        if($changePass != $changePassConfirm) {
            $username = $this->model->getUsernameByID($userID);
            $this->view->viewResetPasswordForm($username, $userID,'Passwords do not match.');
            die;
        }
        else {
            $changePassHash = password_hash($changePass, PASSWORD_DEFAULT);
            $success = $this->model->updateUserPassword($changePassHash,$userID);
            if ($success) {
                header('Location:'.BASE_URL.'login?passreset');
            }
            else {
                $this->view->showError('The query could not be resolved','There was an error attempting to change your password.');
            }
        }
    }

    // Borra un usuario de la BD
    public function removeUser($userID) {
        AuthHelper::getPermission();
        $success = $this->model->deleteUser($userID);
        if($success) {
            header('Location:'.BASE_URL.'user/userlist');
        }
        else {
            var_dump($userID);
            $this->view->showError('The query could not be resolved','The user could not be removed from the database.');
        }
    }

}

/**
 * (*): Quería mostrar los textos "Welcome, [nombre de usuario]" cuando se inicia la sesión,
 * y "You have logged out." cuando se cierra, ambos mostrados en el home.
 */

?>