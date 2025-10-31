<?php
require_once 'Controller.php';

class SupervisorController extends Controller {

    private $pedidoModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] != 'supervisor') {
            header('location: ' . URLROOT . '/auth/login');
            exit();
        }
        $this->pedidoModel = $this->model('Pedido');
    }
    public function index() {
        $pedidos = $this->pedidoModel->obtenerTodos();

        $data = [
            'title' => 'Panel de Supervisor',
            'nombre_usuario' => $_SESSION['user_nombre'] ?? 'Supervisor',
            'pedidos' => $pedidos
        ];

        $this->view('supervisor/panel', $data);
    }
}
