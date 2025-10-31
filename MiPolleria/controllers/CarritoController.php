<?php

require_once 'Controller.php';

class CarritoController extends Controller {

    private $productoModel;
    private $pedidoModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
        $this->productoModel = $this->model('Producto');
        $this->pedidoModel = $this->model('Pedido');
    }

    public function index() {
        $productosEnCarrito = [];
        $subtotal = 0;
        $costo_envio = 10.00;

        if (!empty($_SESSION['carrito'])) {

            foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {
                $producto = $this->productoModel->obtenerProductoPorId($producto_id);
                if ($producto) {
                    $producto->cantidad = $cantidad;
                    $productosEnCarrito[] = $producto;
                    $subtotal += $producto->precio * $cantidad;
                } else {
                    unset($_SESSION['carrito'][$producto_id]);
                }
            }
        }

        $costoEnvioFinal = ($subtotal > 0) ? $costo_envio : 0;
        $total = $subtotal + $costoEnvioFinal;

        $data = [
            'title' => 'Tu Carrito de Compras',
            'productos' => $productosEnCarrito,
            'subtotal' => $subtotal,
            'envio' => $costoEnvioFinal,
            'total' => $total
        ];

        $this->view('pages/carrito', $data);
    }

    public function agregar() {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']); return; }
        $post_data = json_decode(file_get_contents("php://input"));
        $producto_id = filter_var($post_data->id ?? null, FILTER_VALIDATE_INT);
        if (!$producto_id || $producto_id <= 0) { http_response_code(400); echo json_encode(['status' => 'error', 'message' => 'ID de producto no válido.']); return; }
        $_SESSION['carrito'][$producto_id] = ($_SESSION['carrito'][$producto_id] ?? 0) + 1;
        echo json_encode(['status' => 'success', 'message' => 'Producto agregado', 'total_items' => count($_SESSION['carrito'])]);
    }

    public function actualizar() {
        header('Content-Type: application/json');
        $post_data = json_decode(file_get_contents("php://input"));
        $producto_id = filter_var($post_data->id ?? null, FILTER_VALIDATE_INT);
        $operacion = filter_var($post_data->operacion ?? '', FILTER_SANITIZE_STRING);

        if ($producto_id && isset($_SESSION['carrito'][$producto_id])) {
            if ($operacion === 'sumar') { $_SESSION['carrito'][$producto_id]++; } 
            elseif ($operacion === 'restar' && $_SESSION['carrito'][$producto_id] > 1) { $_SESSION['carrito'][$producto_id]--; }
            echo json_encode(['status' => 'success']);
        } else { http_response_code(400); echo json_encode(['status' => 'error']); }
    }

    public function eliminar() {
        header('Content-Type: application/json');
        $post_data = json_decode(file_get_contents("php://input"));
        $producto_id = filter_var($post_data->id ?? null, FILTER_VALIDATE_INT);
        if ($producto_id && isset($_SESSION['carrito'][$producto_id])) {
            unset($_SESSION['carrito'][$producto_id]);
            echo json_encode(['status' => 'success']);
        } else { http_response_code(400); echo json_encode(['status' => 'error']); }
    }

    public function procesar() {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
            return;
        }

        if (empty($_SESSION['carrito'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'El carrito está vacío.']);
            return;
        }

        $productosEnCarrito = [];
        $subtotal = 0;
        foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {
            $producto = $this->productoModel->obtenerProductoPorId($producto_id);
            if ($producto) {
                $producto->cantidad = $cantidad;
                $productosEnCarrito[] = $producto;
                $subtotal += $producto->precio * $cantidad;
            }
        }
        
        $costo_envio = 5.00;
        $total = $subtotal + $costo_envio;
        $dataPedido = [
            'id_usuario' => $_SESSION['user_id'] ?? null,
            'nombre_cliente' => $_SESSION['user_nombre'] ?? 'Cliente Invitado',
            'total' => $total,
            'productos' => $productosEnCarrito
        ];

        if ($this->pedidoModel->crearPedido($dataPedido)) {
            unset($_SESSION['carrito']);

            echo json_encode(['status' => 'success', 'message' => 'Pedido realizado con éxito.']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar el pedido en la base de datos.']);
        }
    }
}