<?php
require_once './app/models/userModel.php';
require_once './app/views/authView.php';
class ControllerAuth{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin() {
        // Muestro el formulario de login
        return $this->view->showLogin();

    }

    public function login() {

        if (empty($_POST['nickname'])) {
            return $this->view->showLogin();
        }
    
        if (empty($_POST['password'])) {
            return $this->view->showLogin();
        }
    
        $nickname = $_POST['nickname'];
        $password = $_POST['password'];
    
        // Verificar que el usuario está en la base de datos
        $userFromDB = $this->model->getUserByNickName($nickname);

        if($userFromDB && password_verify($password, $userFromDB->password)){
            // Guardo en la sesión el ID del usuario
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['NICKNAME_USER'] = $userFromDB->nickname;
            $_SESSION['LAST_ACTIVITY'] = time();
    
            // Redirijo al home
            header('Location: ' . BASE_URL);
            exit();
        } else {
            header("Location: " . BASE_URL . "error");
            return;
        }
    }
    public function showError(){
        $this->view->showError();
    }

    public function showSignup(){
        $this->view->showSignup();
    }

    public function logout() {
        session_start(); // Va a buscar la cookie
        session_destroy(); // Borra la cookie que se buscó
        header('Location: ' . BASE_URL);
    }
}