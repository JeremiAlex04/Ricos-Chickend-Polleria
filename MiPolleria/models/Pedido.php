<?php
// models/Pedido.php

class Pedido {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    /**
     * Crea un nuevo pedido y sus detalles en la base de datos.
     * @param array $data Los datos del pedido.
     * @return bool True si se creó con éxito, false si no.
     */
    public function crearPedido($data) {
        $this->db->beginTransaction();

        try {
            // 1. Insertar en la tabla 'pedidos'
            $sqlPedido = "INSERT INTO pedidos (id_usuario, nombre_cliente, total) VALUES (:id_usuario, :nombre_cliente, :total)";
            $queryPedido = $this->db->prepare($sqlPedido);
            $queryPedido->bindParam(':id_usuario', $data['id_usuario']);
            $queryPedido->bindParam(':nombre_cliente', $data['nombre_cliente']);
            $queryPedido->bindParam(':total', $data['total']);
            $queryPedido->execute();

            $id_pedido = $this->db->lastInsertId();
            $sqlDetalle = "INSERT INTO detalle_pedidos (id_pedido, id_producto, nombre_producto, cantidad, precio_unitario) VALUES (:id_pedido, :id_producto, :nombre_producto, :cantidad, :precio_unitario)";
            $queryDetalle = $this->db->prepare($sqlDetalle);

            foreach ($data['productos'] as $producto) {
                $queryDetalle->bindParam(':id_pedido', $id_pedido);
                $queryDetalle->bindParam(':id_producto', $producto->id);
                $queryDetalle->bindParam(':nombre_producto', $producto->nombre);
                $queryDetalle->bindParam(':cantidad', $producto->cantidad);
                $queryDetalle->bindParam(':precio_unitario', $producto->precio);
                $queryDetalle->execute();
            }

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    /**
     * Obtiene todos los pedidos para el dashboard.
     * @return array La lista de todos los pedidos.
     */
    public function obtenerTodos() {
        try {
            $query = $this->db->prepare("SELECT * FROM pedidos ORDER BY fecha DESC");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * NUEVO: Actualiza el estado de un pedido específico.
     * @param int $idPedido El ID del pedido a actualizar.
     * @param string $nuevoEstado El nuevo estado ('Enviado', 'Completado', 'Cancelado').
     * @return bool True si se actualizó con éxito, false si no.
     */
    public function actualizarEstado($idPedido, $nuevoEstado) {
        try {
            $sql = "UPDATE pedidos SET estado = :estado WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->bindParam(':estado', $nuevoEstado, PDO::PARAM_STR);
            $query->bindParam(':id', $idPedido, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * NUEVO: Obtiene los detalles (productos) de un pedido específico.
     * @param int $idPedido El ID del pedido.
     * @return array La lista de productos del pedido.
     */
    public function obtenerDetallesPorPedidoId($idPedido) {
        try {
            $sql = "SELECT * FROM detalle_pedidos WHERE id_pedido = :id_pedido";
            $query = $this->db->prepare($sql);
            $query->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return [];
        }
    }
}
