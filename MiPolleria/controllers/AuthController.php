<?php
require_once 'Controller.php';

class AuthController extends Controller {

    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('Usuario');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'error' => ''
            ];

            if (empty($data['email']) || empty($data['password'])) {
                $data['error'] = 'Por favor, ingrese email y contraseña.';
                $this->view('admin/login', $data);
                return;
            }

            $loggedInUser = $this->userModel->login($data['email'], $data['password']);

            if ($loggedInUser) {
                $this->createUserSession($loggedInUser);
                switch ($_SESSION['user_rol']) {
                    case 'admin':
                    case 'superadmin':
                        header('location: ' . URLROOT . '/admin/dashboard');
                        break;
                    case 'supervisor':
                         header('location: ' . URLROOT . '/supervisor/index');
                        break;
                    case 'cliente':
                    default:
                         header('location: ' . URLROOT . '/');
                        break;
                }
                exit();
            } else {
                $data['error'] = 'Email o Contraseña Incorrectos.';
                $this->view('admin/login', $data);
            }
        } else {
            $data = ['email' => '', 'password' => '', 'error' => ''];
            $this->view('admin/login', $data);
        }
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_nombre'] = $user->nombre;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_rol'] = $user->rol;
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_nombre']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_rol']);
        session_destroy();
        header('location: ' . URLROOT . '/?logout_success=true');
    }
}
