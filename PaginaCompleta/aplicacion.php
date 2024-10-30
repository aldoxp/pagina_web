<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    header("Location: aplicacion_iniciosesion.php");
    exit();
}

$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'usuario'; // Verifica si el usuario es administrador


// Lógica para cerrar sesión
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: aplicacioon_iniciosesion.php");
    exit();
}
?>
<html>
    <head>
        <title>INICIO</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                  <?php include_once 'aplicacion_header.php'; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <?php include_once 'aplicacion_menu.php'; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <?php include_once 'aplicacion_banneri.php'; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <?php include_once 'aplicacion_carrusel.php'; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <?php include_once 'aplicacion_contenido.php'; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <?php include_once 'aplicacion_diofertas.php'; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <?php include_once 'aplicacion_pie.php'; ?>
                </div>
            </div>
        </div>
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
