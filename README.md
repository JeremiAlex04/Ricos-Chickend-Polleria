# 🍗 Ricos Chicken - Sistema de Gestión de Pollería

Bienvenido al repositorio de **Ricos Chicken**, una aplicación web completa desarrollada en PHP bajo el patrón de arquitectura **MVC (Modelo-Vista-Controlador)**. Este sistema permite la gestión integral de una pollería, incluyendo ventas, administración de productos, usuarios y pedidos.

## 🚀 Características Principales

*   **Arquitectura MVC:** Código organizado y escalable separado en Modelos, Vistas y Controladores.
*   **Gestión de Usuarios:** Roles diferenciados para Super Administrador, Administrador, Supervisor y Clientes.
*   **Catálogo de Productos:** Administración completa (CRUD) de productos, categorías y ofertas.
*   **Carrito de Compras:** Funcionalidad para que los clientes realicen pedidos en línea.
*   **Gestión de Pedidos:** Panel administrativo para visualizar y cambiar el estado de los pedidos.
*   **Interfaz Amigable:** Diseño web responsivo y fácil de usar.

## 🛠️ Tecnologías Utilizadas

*   **Lenguaje:** PHP 8.x
*   **Base de Datos:** MySQL / MariaDB
*   **Frontend:** HTML5, CSS3, JavaScript
*   **Servidor Web:** Apache (XAMPP/WAMP/Laragon recomendado)

## 📋 Requisitos Previos

*   Servidor web local (XAMPP, WAMP, MAMP o similar).
*   PHP 8.0 o superior.
*   MySQL.

## 🔧 Instalación y Configuración

Sigue estos pasos para desplegar el proyecto en tu entorno local:

1.  **Clonar el Repositorio**
    Descarga el proyecto o clónalo usando Git:
    ```bash
    git clone <URL_DEL_REPOSITORIO>
    ```

2.  **Ubicación del Proyecto**
    Mueve la carpeta del proyecto (`Ricos-Chickend-Polleria-main`) a la carpeta pública de tu servidor web (por ejemplo, `htdocs` en XAMPP o `www` en WAMP).

3.  **Base de Datos**
    *   Abre tu gestor de base de datos (ej. phpMyAdmin).
    *   Crea una nueva base de datos llamada `polleria_db`.
    *   Importa el archivo SQL ubicado en:
        `Ricos-Chickend-Polleria-main/polleria_db.sql`

4.  **Configuración de Conexión**
    Abre el archivo de configuración de la base de datos:
    `MiPolleria/config/Database.php`
    
    Asegúrate de que las credenciales coincidan con tu servidor local:
    ```php
    private $host = 'localhost';
    private $db_name = 'polleria_db';
    private $username = 'root'; // Tu usuario de MySQL
    private $password = '';     // Tu contraseña de MySQL
    ```

5.  **Configuración de la URL**
    Abre el archivo de configuración general:
    `MiPolleria/config/config.php`
    
    Verifica que la constante `URLROOT` apunte a la ruta correcta de tu proyecto:
    ```php
    define('URLROOT', 'http://localhost/MiPolleria');
    ```
    *Nota: Si cambiaste el nombre de la carpeta, actualiza esta línea.*

## 👤 Usuarios Predefinidos

El sistema cuenta con los siguientes usuarios de prueba (según la base de datos):

| Rol | Email |
| :--- | :--- |
| **Super Admin** | `superadmin@ricoschicken.com` |
| **Admin** | `admin@ricoschicken.com` |
| **Supervisor** | `supervisor@ricoschicken.com` |
| **Cliente** | `cliente@ricoschicken.com` |

## 📂 Estructura del Proyecto

```
Ricos-Chickend-Polleria-main/
├── MiPolleria/
│   ├── config/          # Archivos de configuración (BD, Constantes)
│   ├── controllers/     # Controladores del sistema
│   ├── models/          # Modelos de datos
│   ├── public/          # Archivos estáticos (CSS, JS, Imágenes)
│   ├── views/           # Vistas (Plantillas HTML/PHP)
│   └── index.php        # Punto de entrada de la aplicación
└── polleria_db.sql      # Script de la base de datos
```

## 🤝 Contribución

Si deseas contribuir a este proyecto, por favor crea un *fork* y envía un *pull request* con tus mejoras.

---
Desarrollado para **Ricos Chicken**.
