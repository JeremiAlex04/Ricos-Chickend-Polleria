<?php
require_once 'Controller.php';

class AdminController extends Controller {

    private $productoModel;
    private $pedidoModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }

        if (!isset($_SESSION['user_rol']) || ($_SESSION['user_rol'] != 'admin' && $_SESSION['user_rol'] != 'superadmin')) {
            header('location: ' . URLROOT . '/auth/login');
            exit();
        }
        $this->productoModel = $this->model('Producto');
        $this->pedidoModel = $this->model('Pedido');
    }

    public function dashboard() {
        $data = [
            'title' => 'Dashboard de Administrador',
            'nombre_usuario' => $_SESSION['user_nombre'] ?? 'Admin'
        ];
        $this->view('admin/dashboard', $data);
    }

    public function gestionarProductos() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $_POST['id'] ?? null,
                'nombre' => trim($_POST['nombre']),
                'descripcion' => trim($_POST['descripcion']),
                'precio' => trim($_POST['precio']),
                'categoria' => trim($_POST['categoria']),
                'imagen_url' => trim($_POST['imagen_url']),
                'es_oferta' => isset($_POST['es_oferta']) ? 1 : 0,
                'precio_oferta' => !empty($_POST['precio_oferta']) ? trim($_POST['precio_oferta']) : null,
                'es_popular' => isset($_POST['es_popular']) ? 1 : 0,
            ];

            if (!empty($data['id'])) {
                $this->productoModel->actualizarProducto($data);
            } else {
                $this->productoModel->agregarProducto($data);
            }

            header('location: ' . URLROOT . '/admin/gestionarProductos');
        } else {
            $productos = $this->productoModel->obtenerTodosParaAdmin();
            $data = [
                'title' => 'Gestionar Productos',
                'nombre_usuario' => $_SESSION['user_nombre'],
                'productos' => $productos
            ];
            $this->view('admin/gestionar_productos', $data);
        }
    }

    public function desactivarProducto($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->productoModel->desactivarProducto($id);
            header('location: ' . URLROOT . '/admin/gestionarProductos');
        } else {
            header('location: ' . URLROOT . '/admin/gestionarProductos');
        }
    }

    public function reactivarProducto($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->productoModel->reactivarProducto($id);
            header('location: ' . URLROOT . '/admin/gestionarProductos');
        } else {
            header('location: ' . URLROOT . '/admin/gestionarProductos');
        }
    }

    public function verPedidos() {
        // Le pedimos al modelo que nos de todos los pedidos
        $pedidos = $this->pedidoModel->obtenerTodos();

        $data = [
            'title' => 'Historial de Pedidos',
            'nombre_usuario' => $_SESSION['user_nombre'],
            'pedidos' => $pedidos
        ];

        $this->view('admin/ver_pedidos', $data);
    }

    /**
     * NUEVO: Cambia el estado de un pedido.
     * @param int $id El ID del pedido.
     */
    public function cambiarEstadoPedido($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['estado'])) {
            $nuevoEstado = filter_var($_POST['estado'], FILTER_SANITIZE_STRING);
            if ($this->pedidoModel->actualizarEstado($id, $nuevoEstado)) {
                // Éxito
            } else {
                // Manejar error si se desea
            }
        }
        header('location: ' . URLROOT . '/admin/verPedidos');
    }

    /**
     * NUEVO: Obtiene los detalles de un pedido para mostrar en un modal (vía AJAX).
     * @param int $id El ID del pedido.
     */
    public function verDetallePedido($id) {
        header('Content-Type: application/json');
        $detalles = $this->pedidoModel->obtenerDetallesPorPedidoId($id);
        echo json_encode($detalles);
    }
}