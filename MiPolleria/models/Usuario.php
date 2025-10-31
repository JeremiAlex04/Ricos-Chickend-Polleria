<?php

class Usuario {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    /**
     * Busca un usuario en la base de datos por su email.
     * @param string $email El email del usuario a buscar.
     * @return object|false Retorna el objeto del usuario si se encuentra, o false si no.
     */
    public function findUserByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = :email');
        $query->bindParam(':email', $email);
        $query->execute();

        if ($query->rowCount() > 0) {
            return $query->fetch(PDO::FETCH_OBJ);
        } else {
            return false;
        }
    }

    /**
     * Verifica el login de un usuario.
     * @param string $email El email ingresado.
     * @param string $password La contraseña ingresada.
     * @return object|false Retorna el objeto del usuario si la contraseña es correcta, o false si no.
     */
    public function login($email, $password) {
        $user = $this->findUserByEmail($email);

        if ($user === false) {
            return false;
        }

        $hashedPassword = $user->password;
        if (password_verify($password, $hashedPassword)) {
            return $user;
        } else {
            return false;
        }
    }
}
?>