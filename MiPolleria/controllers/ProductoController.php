<?php

require_once 'Controller.php';

class ProductoController extends Controller {

    private $productoModel;

    public function __construct() {
        $this->productoModel = $this->model('Producto');
    }

    public function menu() {
        $data = [
            'title' => 'Nuestro Menú',
            'productos' => $this->productoModel->obtenerTodosLosProductos() ?? []
        ];
        $this->view('pages/menu', $data);
    }

    public function index() {
        $data = [
            'title' => 'Todos Nuestros Productos',
            'productos' => $this->productoModel->obtenerTodosLosProductos() ?? []
        ];
        $this->view('pages/productos', $data);
    }

    public function ofertas() {
        $data = [
            'title' => 'Ofertas Especiales',
            'productos' => $this->productoModel->obtenerOfertas() ?? []
        ];
        $this->view('pages/ofertas', $data);
    }
}