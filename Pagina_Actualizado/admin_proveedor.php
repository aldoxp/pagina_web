<?php
session_start();

// Verifica si el usuario ya ha iniciado sesión
if (!isset($_SESSION['user'])) {
    header("Location: aplicacion_iniciosesion.php"); // Redirige si no ha iniciado sesión
    exit();
}

$role = $_SESSION['role'];
if ($role !== 'admin') {
    header("Location: aplicacion_administracion.php"); // Redirige si no es admin
    exit();
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paperworld";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar nuevo proveedor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $nombre = $_POST['nombre_proveedor'];
    $direccion = $_POST['direccion_proveedor'];
    $telefono = $_POST['telefono_proveedor'];
    $correo = $_POST['correo_proveedor'];

    $sql = "INSERT INTO proveedores (nombre_proveedor, direccion_proveedor, telefono_proveedor, correo_proveedor)
            VALUES ('$nombre', '$direccion', '$telefono', '$correo')";
    $conn->query($sql);
}

// Editar proveedor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = $_POST['id_proveedor'];
    $nombre = $_POST['nombre_proveedor'];
    $direccion = $_POST['direccion_proveedor'];
    $telefono = $_POST['telefono_proveedor'];
    $correo = $_POST['correo_proveedor'];

    $sql = "UPDATE proveedores SET
            nombre_proveedor = '$nombre',
            direccion_proveedor = '$direccion',
            telefono_proveedor = '$telefono',
            correo_proveedor = '$correo'
            WHERE id_proveedor = $id";
    $conn->query($sql);
}

// Eliminar proveedor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $id = $_POST['id_proveedor'];
    $sql = "DELETE FROM proveedores WHERE id_proveedor = $id";
    $conn->query($sql);
}

// Obtener proveedores
$sql = "SELECT * FROM proveedores";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Proveedores</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gestionar Proveedores</h1>

    <form method="POST">
        <h2>Agregar Proveedor</h2>
        <input type="text" name="nombre_proveedor" placeholder="Nombre" required>
        <input type="text" name="direccion_proveedor" placeholder="Dirección">
        <input type="text" name="telefono_proveedor" placeholder="Teléfono">
        <input type="email" name="correo_proveedor" placeholder="Correo">
        <button type="submit" name="agregar">Agregar Proveedor</button>
    </form>

    <h2>Lista de Proveedores</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id_proveedor']; ?></td>
            <td><?php echo $row['nombre_proveedor']; ?></td>
            <td><?php echo $row['direccion_proveedor']; ?></td>
            <td><?php echo $row['telefono_proveedor']; ?></td>
            <td><?php echo $row['correo_proveedor']; ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id_proveedor" value="<?php echo $row['id_proveedor']; ?>">
                    <input type="text" name="nombre_proveedor" value="<?php echo $row['nombre_proveedor']; ?>" required>
                    <input type="text" name="direccion_proveedor" value="<?php echo $row['direccion_proveedor']; ?>">
                    <input type="text" name="telefono_proveedor" value="<?php echo $row['telefono_proveedor']; ?>">
                    <input type="email" name="correo_proveedor" value="<?php echo $row['correo_proveedor']; ?>">
                    <button type="submit" name="editar">Editar</button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id_proveedor" value="<?php echo $row['id_proveedor']; ?>">
                    <button type="submit" name="eliminar" onclick="return confirm('¿Estás seguro de eliminar este proveedor?');">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <?php $conn->close(); ?>
</body>
</html>
