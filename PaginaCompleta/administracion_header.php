<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Verifica si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    header("Location: aplicacion_iniciosesion.php");
    exit();
}

$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin'; // Verifica si el usuario es administrador



// Lógica para cerrar sesión
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: aplicacion_iniciosesion.php");
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Papelería Kathy</title>
    <style>
        /* Estilos básicos */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        /* Encabezado y barra de navegación */
        header {
            background-color: #333;
            color: #fff;
            padding: 1.5em;
            text-align: center;
        }

        nav {
            background-color: #444;
            overflow: hidden;
        }

        nav a {
            float: left;
            color: #f2f2f2;
            padding: 1em 1.5em;
            text-align: center;
            text-decoration: none;
            font-size: 1em;
        }

        nav a:hover {
            background-color: #666;
            color: white;
        }

        /* Contenido principal */
        main {
            padding: 2em;
            margin-top: 20px;
            text-align: center;
        }

        section {
            margin-bottom: 2em;
            background-color: #fff;
            padding: 1.5em;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 0.5em 1em;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<header>
    <h1>Administración de Papelería Kathy</h1>
</header>

<nav>
    <a href="aplicacion_administracion.php?pag=inicio">Inicio</a>
    <a href="aplicacion_administracion.php?pag=inv">Inventario</a>
    <a href="aplicacion_administracion.php?pag=ventas">Ventas</a>
    <a href="aplicacion_administracion.php?pag=users">Usuarios</a>
    <a href="aplicacion_administracion.php?pag=prov">Proveedores</a>
    <a href="aplicacion_administracion.php?pag=prod">Productos</a>
    <a onclick="window.location.href='administracion_header.php?action=logout';" style="cursor: pointer;">Cerrar sesión</a>
</nav>