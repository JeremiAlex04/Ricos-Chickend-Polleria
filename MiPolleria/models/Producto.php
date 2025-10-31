<?php

class Producto {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function obtenerTodosLosProductos() {
        try {
            $query = $this->db->prepare('SELECT * FROM productos WHERE activo = 1 ORDER BY id DESC');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) { return []; }
    }

    public function obtenerTodosParaAdmin() {
        try {
            $query = $this->db->prepare('SELECT * FROM productos ORDER BY id DESC');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) { return []; }
    }

    public function obtenerProductoPorId($id) {
        try {
            $query = $this->db->prepare('SELECT * FROM productos WHERE id = :id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) { return false; }
    }

    public function obtenerOfertas() {
        try {
            $query = $this->db->prepare('SELECT * FROM productos WHERE es_oferta = TRUE AND activo = 1 LIMIT 3');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) { return []; }
    }

    public function obtenerPopulares() {
        try {
            $query = $this->db->prepare('SELECT * FROM productos WHERE es_popular = TRUE AND activo = 1 LIMIT 3');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) { return []; }
    }

    public function agregarProducto($data) {
        try {
            $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria, imagen_url, es_oferta, precio_oferta, es_popular, activo) VALUES (:nombre, :descripcion, :precio, :categoria, :imagen_url, :es_oferta, :precio_oferta, :es_popular, 1)";
            $query = $this->db->prepare($sql);

            $query->bindParam(':nombre', $data['nombre']);
            $query->bindParam(':descripcion', $data['descripcion']);
            $query->bindParam(':precio', $data['precio']);
            $query->bindParam(':categoria', $data['categoria']);
            $query->bindParam(':imagen_url', $data['imagen_url']);
            $query->bindParam(':es_oferta', $data['es_oferta'], PDO::PARAM_BOOL);
            $query->bindParam(':precio_oferta', $data['precio_oferta']);
            $query->bindParam(':es_popular', $data['es_popular'], PDO::PARAM_BOOL);

            return $query->execute();
        } catch (PDOException $e) { return false; }
    }

    public function actualizarProducto($data) {
        try {
            $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, categoria = :categoria, imagen_url = :imagen_url, es_oferta = :es_oferta, precio_oferta = :precio_oferta, es_popular = :es_popular WHERE id = :id";
            $query = $this->db->prepare($sql);

            $query->bindParam(':id', $data['id']);
            $query->bindParam(':nombre', $data['nombre']);
            $query->bindParam(':descripcion', $data['descripcion']);
            $query->bindParam(':precio', $data['precio']);
            $query->bindParam(':categoria', $data['categoria']);
            $query->bindParam(':imagen_url', $data['imagen_url']);
            $query->bindParam(':es_oferta', $data['es_oferta'], PDO::PARAM_BOOL);
            $query->bindParam(':precio_oferta', $data['precio_oferta']);
            $query->bindParam(':es_popular', $data['es_popular'], PDO::PARAM_BOOL);

            return $query->execute();
        } catch (PDOException $e) { return false; }
    }

    public function desactivarProducto($id) {
        try {
            $sql = "UPDATE productos SET activo = 0 WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) { return false; }
    }

    public function reactivarProducto($id) {
        try {
            $sql = "UPDATE productos SET activo = 1 WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) { return false; }
    }
}