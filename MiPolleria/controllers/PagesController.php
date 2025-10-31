<?php
// controllers/PagesController.php

require_once 'Controller.php';

class PagesController extends Controller {

    public function __construct() {

    }

    public function index() {
        $productoModel = $this->model('Producto');

        $ofertas = $productoModel->obtenerOfertas();
        $populares = $productoModel->obtenerPopulares();

        $data = [
            'title' => 'Bienvenido a Ricos Chicken',
            'ofertas' => $ofertas,
            'populares' => $populares
        ];

        $this->view('pages/inicio', $data);
    }

    public function contacto() {
        $data = ['title' => 'Contacto'];
        $this->view('pages/contacto', $data);
    }

    public function delivery() {
        $data = ['title' => 'Delivery'];
        $this->view('pages/delivery', $data);
    }

    public function menu() {

        header('location: ' . URLROOT . '/producto/menu');
    }

    public function ofertas() {
        header('location: ' . URLROOT . '/producto/ofertas');
    }
    
    public function productos() {
        header('location: ' . URLROOT . '/producto/index');
    }
    
    public function carrito() {
        header('location: ' . URLROOT . '/carrito/index');
    }
}