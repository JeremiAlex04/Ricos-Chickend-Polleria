<?php

class Controller {

    /**
     * Carga y retorna una instancia del modelo especificado.
     * @param string $model Nombre del modelo a cargar (ej: 'Producto').
     * @return object|null La instancia del modelo o null si no se encuentra.
     */
    public function model($model) {
        $modelPath = 'models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        }
        return null;
    }

    /**
     * Carga la vista especificada.
     * @param string $view Nombre de la vista a cargar (ej: 'pages/inicio').
     * @param array $data Datos para pasar a la vista.
     */
    public function view($view, $data = []) {
        $viewPath = 'views/' . $view . '.php';
        if (file_exists($viewPath)) {
            extract($data);
            require_once $viewPath;
        } else {
            die('La vista no existe: ' . $viewPath);
        }
    }
}
?>
