<?php
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

// Eliminar usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    if (!empty($_POST['usuarios'])) {
        $usuarios_a_eliminar = implode(",", $_POST['usuarios']);
        echo "Usuarios seleccionados para eliminar: $usuarios_a_eliminar<br>";

        $sql_delete = "DELETE FROM usuarios WHERE id_usuario IN ($usuarios_a_eliminar)";
        if ($conn->query($sql_delete) === TRUE) {
            echo "<div class='alert success'>Usuarios eliminados exitosamente.</div><br>";
        } else {
            echo "<div class='alert error'>Error al eliminar usuarios: " . $conn->error . "</div><br>";
        }
    } else {
        echo "<div class='alert warning'>No se seleccionó ningún usuario para eliminar.</div><br>";
    }
}

// Insertar nuevo usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertar'])) {
    $username = $_POST['Username_U'];
    $nombre = $_POST['Nombre_U'];
    $apellidos = $_POST['Apellidos_U'];
    $contraseña = $_POST['Contraseña'];
    $direccion = $_POST['Direccion_U'];
    $telefono = $_POST['Telefono_U'];
    $correo = $_POST['Correo'];
    $rol = $_POST['Rol'];

    $sql = "INSERT INTO usuarios (Username_U, Nombre_U, Apellidos_U, Contraseña, Direccion_U, Telefono_U, Correo, Rol) 
            VALUES ('$username', '$nombre', '$apellidos', '$contraseña', '$direccion', '$telefono', '$correo', '$rol')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert success'>Nuevo usuario registrado exitosamente</div><br>";
    } else {
        echo "<div class='alert error'>Error: " . $conn->error . "</div><br>";
    }
}

// Editar usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
    $id_usuario = $_POST['id_usuario'];
    $username = $_POST['Username_U'];
    $nombre = $_POST['Nombre_U'];
    $apellidos = $_POST['Apellidos_U'];
    $contraseña = $_POST['Contraseña'];
    $direccion = $_POST['Direccion_U'];
    $telefono = $_POST['Telefono_U'];
    $correo = $_POST['Correo'];
    $rol = $_POST['Rol'];

    $sql_update = "UPDATE usuarios SET Username_U='$username', Nombre_U='$nombre', Apellidos_U='$apellidos', 
                   Contraseña='$contraseña', Direccion_U='$direccion', Telefono_U='$telefono', Correo='$correo', 
                   Rol='$rol' WHERE id_usuario='$id_usuario'";

    if ($conn->query($sql_update) === TRUE) {
        echo "<div class='alert success'>Usuario actualizado exitosamente.</div><br>";
    } else {
        echo "<div class='alert error'>Error al actualizar usuario: " . $conn->error . "</div><br>";
    }
}

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"],
        input[type="button"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #4cae4c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .hidden {
            display: none;
        }
        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
        }
        .warning {
            background-color: #fcf8e3;
            color: #8a6d3b;
        }
        .boton-actualizar {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        .boton-actualizar:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
    <h1>Gestionar Usuarios</h1>

    <!-- Formulario de Inserción -->
    <h2>Insertar Nuevo Usuario</h2>
    <form method="post" action="">
        <label>Username:</label><input type="text" name="Username_U" required>
        <label>Nombre:</label><input type="text" name="Nombre_U" required>
        <label>Apellidos:</label><input type="text" name="Apellidos_U" required>
        <label>Contraseña:</label><input type="password" name="Contraseña" required>
        <label>Dirección:</label><input type="text" name="Direccion_U" required>
        <label>Teléfono:</label><input type="text" name="Telefono_U" required>
        <label>Correo:</label><input type="email" name="Correo" required>
        <label>Rol:</label><input type="text" name="Rol" required>
        <input type="submit" name="insertar" value="Insertar Usuario">
    </form>

    <!-- Formulario para Eliminar Usuarios -->
    <form method="post" action="">
        <h2>Usuarios Registrados</h2>
        <table>
            <tr>
                <th>Seleccionar</th>
                <th>ID Usuario</th>
                <th>Username</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Contraseña</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Rol</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='usuarios[]' value='" . $row["id_usuario"] . "' onclick='toggleEditButton(this)'></td>";
                    echo "<td>" . $row["id_usuario"] . "</td>";
                    echo "<td>" . $row["Username_U"] . "</td>";
                    echo "<td>" . $row["Nombre_U"] . "</td>";
                    echo "<td>" . $row["Apellidos_U"] . "</td>";
                    echo "<td>" . $row["Contraseña"] . "</td>";
                    echo "<td>" . $row["Direccion_U"] . "</td>";
                    echo "<td>" . $row["Telefono_U"] . "</td>";
                    echo "<td>" . $row["Correo"] . "</td>";
                    echo "<td>" . $row["Rol"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No hay usuarios registrados</td></tr>";
            }
            ?>
        </table>
        <br>
        <input type="submit" name="eliminar" value="Eliminar Usuario">
        <input type="button" id="editButton" value="Editar Usuario" onclick="editSelected()" disabled>
    </form>

    <!-- Formulario de Edición -->
    <div id="editForm" class="hidden">
        <h2>Editar Usuario</h2>
        <form method="post" action="">
            <input type="hidden" id="editId" name="id_usuario">
            <label>Username:</label><input type="text" id="editUsername" name="Username_U" required>
            <label>Nombre:</label><input type="text" id="editNombre" name="Nombre_U" required>
            <label>Apellidos:</label><input type="text" id="editApellidos" name="Apellidos_U" required>
            <label>Contraseña:</label><input type="password" id="editContraseña" name="Contraseña" required>
            <label>Dirección:</label><input type="text" id="editDireccion" name="Direccion_U" required>
            <label>Teléfono:</label><input type="text" id="editTelefono" name="Telefono_U" required>
            <label>Correo:</label><input type="email" id="editCorreo" name="Correo" required>
            <label>Rol:</label><input type="text" id="editRol" name="Rol" required>
            <input type="submit" name="editar" value="Actualizar Usuario">
        </form>
    </div>

    <script>
        function toggleEditButton(checkbox) {
            const editButton = document.getElementById('editButton');
            editButton.disabled = !checkbox.checked;
        }

        function editSelected() {
            const checkboxes = document.querySelectorAll('input[name="usuarios[]"]:checked');
            if (checkboxes.length === 1) {
                const row = checkboxes[0].closest('tr'); // Cambié esto para obtener la fila correcta
                const cells = row.getElementsByTagName('td');

                document.getElementById('editId').value = cells[1].innerText;
                document.getElementById('editUsername').value = cells[2].innerText;
                document.getElementById('editNombre').value = cells[3].innerText;
                document.getElementById('editApellidos').value = cells[4].innerText;
                document.getElementById('editContraseña').value = cells[5].innerText;
                document.getElementById('editDireccion').value = cells[6].innerText;
                document.getElementById('editTelefono').value = cells[7].innerText;
                document.getElementById('editCorreo').value = cells[8].innerText;
                document.getElementById('editRol').value = cells[9].innerText;

                document.getElementById('editForm').classList.remove('hidden');
            } else {
                alert("Por favor, selecciona un usuario para editar.");
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
