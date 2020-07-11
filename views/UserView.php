<?php
// vista: interfaz del usuario (frontend)
require_once('views/View.php');

class UserView extends View {

    function __construct() {
        parent::__construct();
    }

    // Muestra el panel de usuario
    function viewProfile($iduser,$isadmin) {
        $this->getSmarty()->assign('pageName','User Control Panel');
        $this->getSmarty()->assign('pageTitle','User Control Panel');
        $this->getSmarty()->assign('iduser',$iduser);
        $this->getSmarty()->assign('isadmin',$isadmin);
        $this->getSmarty()->display('templates/user_ctrlPanel.tpl');
    }

    // Muestra formulario de inicio de sesión
    public function viewLogin($error=null) {
        $this->getSmarty()->assign('pageName', 'User Login');
        $this->getSmarty()->assign('pageTitle', 'Login');
        $this->getSmarty()->assign('error',$error);
        $this->getSmarty()->assign('formType',false); // si es false, inicia sesión
        $this->getSmarty()->display('templates/user_form.tpl');
    }

    // Muestra formulario de registro
    public function viewSignupForm($error=null) {
        $this->getSmarty()->assign('pageName', 'Account registration');
        $this->getSmarty()->assign('pageTitle', 'Sign up');
        $this->getSmarty()->assign('error',$error);
        $this->getSmarty()->assign('formType',true); // si es true, registra un usuario
        $this->getSmarty()->display('templates/user_form.tpl');
    }

    // Pide respuesta a pregunta de seguridad para reestablecer contraseña
    public function viewSecQuestionPrompt($error=null) {
        $this->getSmarty()->assign('pageName', 'Password Reset: Security Question');
        $this->getSmarty()->assign('pageTitle', 'Security question');
        $this->getSmarty()->assign('error',$error);
        $this->getSmarty()->display('templates/user_questionprompt.tpl');
    }

    // Muestra formulario de reestablecer contraseña
    public function viewResetPasswordForm($recoveryUsername, $recoveryUserID, $error=null) {
        $this->getSmarty()->assign('pageName', 'Password Reset: New Password Entry');
        $this->getSmarty()->assign('pageTitle', 'Confirm password reset');
        $this->getSmarty()->assign('recoveryUsername',$recoveryUsername);
        $this->getSmarty()->assign('recoveryUserID',$recoveryUserID);
        $this->getSmarty()->assign('error',$error);
        $this->getSmarty()->display('templates/user_changepass.tpl');
    }

    // Muestra la página principal
    public function viewHome($msg=null) {
        $this->getSmarty()->assign('pageName', 'Home');
        $this->getSmarty()->assign('pageTitle', 'Corador Musical Instruments');
        $this->getSmarty()->assign('msg',$msg);
        $this->getSmarty()->display('templates/home.tpl');
    }

    public function viewUserList($users) {
        $this->getSmarty()->assign('pageName', 'Admin Control Panel: User List');
        $this->getSmarty()->assign('pageTitle', 'User list');
        $this->getSmarty()->assign('users',$users);
        $this->getSmarty()->display('templates/user_userList.tpl');
    }

}

?>