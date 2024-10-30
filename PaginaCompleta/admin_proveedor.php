<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Eliminar proveedor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    if (!empty($_POST['proveedores'])) {
        $proveedores_a_eliminar = implode(",", $_POST['proveedores']);
        echo "Proveedores seleccionados para eliminar: $proveedores_a_eliminar<br>";

        $sql_delete = "DELETE FROM proveedores WHERE id_proveedor IN ($proveedores_a_eliminar)";
        if ($conn->query($sql_delete) === TRUE) {
            echo "<div class='alert success'>Proveedores eliminados exitosamente.</div><br>";
        } else {
            echo "<div class='alert error'>Error al eliminar proveedores: " . $conn->error . "</div><br>";
        }
    } else {
        echo "<div class='alert warning'>No se seleccionó ningún proveedor para eliminar.</div><br>";
    }
}

// Insertar nuevo proveedor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertar'])) {
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $direccion_proveedor = $_POST['direccion_proveedor'];
    $telefono_proveedor = $_POST['telefono_proveedor'];
    $correo_proveedor = $_POST['correo_proveedor'];

    $sql = "INSERT INTO proveedores (nombre_proveedor, direccion_proveedor, telefono_proveedor, correo_proveedor) 
            VALUES ('$nombre_proveedor', '$direccion_proveedor', '$telefono_proveedor', '$correo_proveedor')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert success'>Nuevo proveedor registrado exitosamente</div><br>";
    } else {
        echo "<div class='alert error'>Error: " . $conn->error . "</div><br>";
    }
}

// Editar proveedor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
    $id_proveedor = $_POST['id_proveedor'];
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $direccion_proveedor = $_POST['direccion_proveedor'];
    $telefono_proveedor = $_POST['telefono_proveedor'];
    $correo_proveedor = $_POST['correo_proveedor'];

    $sql_update = "UPDATE proveedores SET nombre_proveedor='$nombre_proveedor', direccion_proveedor='$direccion_proveedor', 
                   telefono_proveedor='$telefono_proveedor', correo_proveedor='$correo_proveedor' 
                   WHERE id_proveedor='$id_proveedor'";

    if ($conn->query($sql_update) === TRUE) {
        echo "<div class='alert success'>Proveedor actualizado exitosamente.</div><br>";
    } else {
        echo "<div class='alert error'>Error al actualizar proveedor: " . $conn->error . "</div><br>";
    }
}

$sql = "SELECT * FROM proveedores";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Proveedores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h1, h2 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .warning {
            background-color: #fff3cd;
            color: #856404;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"], input[type="button"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #0056b3;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Gestionar Proveedores</h1>

    <!-- Formulario de Inserción -->
    <h2>Insertar Nuevo Proveedor</h2>
    <form method="post" action="">
        <label>Nombre del Proveedor:</label>
        <input type="text" name="nombre_proveedor" required>
        
        <label>Dirección:</label>
        <input type="text" name="direccion_proveedor">
        
        <label>Teléfono:</label>
        <input type="text" name="telefono_proveedor">
        
        <label>Correo:</label>
        <input type="email" name="correo_proveedor">
        
        <input type="submit" name="insertar" value="Insertar Proveedor">
    </form>

    <!-- Formulario para Eliminar Proveedores -->
    <form method="post" action="">
        <h2>Proveedores Registrados</h2>
        <table>
            <tr>
                <th>Seleccionar</th>
                <th>ID Proveedor</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='proveedores[]' value='" . $row["id_proveedor"] . "' onclick='toggleEditButton(this)'></td>";
                    echo "<td>" . $row["id_proveedor"] . "</td>";
                    echo "<td>" . $row["nombre_proveedor"] . "</td>";
                    echo "<td>" . $row["direccion_proveedor"] . "</td>";
                    echo "<td>" . $row["telefono_proveedor"] . "</td>";
                    echo "<td>" . $row["correo_proveedor"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay proveedores registrados</td></tr>";
            }
            ?>
        </table>
        <br>
        <input type="submit" name="eliminar" value="Eliminar Proveedor">
        <input type="button" id="editButton" value="Editar Proveedor" onclick="editSelected()" disabled>
    </form>

    <!-- Formulario de Edición -->
    <div id="editForm" class="hidden">
        <h2>Editar Proveedor</h2>
        <form method="post" action="">
            <input type="hidden" id="editId" name="id_proveedor">
            <label>Nombre del Proveedor:</label>
            <input type="text" id="editNombre" name="nombre_proveedor" required>
            
            <label>Dirección:</label>
            <input type="text" id="editDireccion" name="direccion_proveedor">
            
            <label>Teléfono:</label>
            <input type="text" id="editTelefono" name="telefono_proveedor">
            
            <label>Correo:</label>
            <input type="email" id="editCorreo" name="correo_proveedor">
            
            <input type="submit" name="editar" value="Actualizar Proveedor">
        </form>
    </div>

    <script>
        function toggleEditButton(checkbox) {
            const editButton = document.getElementById('editButton');
            editButton.disabled = !document.querySelector('input[name="proveedores[]"]:checked');
        }

        function editSelected() {
            const checkboxes = document.querySelectorAll('input[name="proveedores[]"]:checked');
            if (checkboxes.length === 1) {
                const row = checkboxes[0].closest('tr');
                document.getElementById('editId').value = row.cells[1].innerText;
                document.getElementById('editNombre').value = row.cells[2].innerText;
                document.getElementById('editDireccion').value = row.cells[3].innerText;
                document.getElementById('editTelefono').value = row.cells[4].innerText;
                document.getElementById('editCorreo').value = row.cells[5].innerText;
                document.getElementById('editForm').classList.remove('hidden');
            } else {
                alert("Por favor, selecciona un solo proveedor para editar.");
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
