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

// Eliminar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    if (!empty($_POST['productos'])) {
        $productos_a_eliminar = implode(",", $_POST['productos']);
        echo "Productos seleccionados para eliminar: $productos_a_eliminar<br>";

        $sql_delete = "DELETE FROM productos WHERE id_producto IN ($productos_a_eliminar)";
        if ($conn->query($sql_delete) === TRUE) {
            echo "<div class='alert success'>Productos eliminados exitosamente.</div><br>";
        } else {
            echo "<div class='alert error'>Error al eliminar productos: " . $conn->error . "</div><br>";
        }
    } else {
        echo "<div class='alert warning'>No se seleccionó ningún producto para eliminar.</div><br>";
    }
}

// Insertar nuevo producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertar'])) {
    $nombre_p = $_POST['nombre_p'];
    $cantidad_p = $_POST['cantidad_p'];
    $precio_p = $_POST['precio_p'];
    $porcentaje_iva = $_POST['porcentaje_iva'];
    $id_categoria = $_POST['id_categoria'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO productos (nombre_p, cantidad_p, precio_p, porcentaje_iva, id_categoria, estado) 
            VALUES ('$nombre_p', '$cantidad_p', '$precio_p', '$porcentaje_iva', '$id_categoria', '$estado')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert success'>Nuevo producto registrado exitosamente</div><br>";
    } else {
        echo "<div class='alert error'>Error: " . $conn->error . "</div><br>";
    }
}

// Editar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
    $id_producto = $_POST['id_producto'];
    $nombre_p = $_POST['nombre_p'];
    $cantidad_p = $_POST['cantidad_p'];
    $precio_p = $_POST['precio_p'];
    $porcentaje_iva = $_POST['porcentaje_iva'];
    $id_categoria = $_POST['id_categoria'];
    $estado = $_POST['estado'];

    $sql_update = "UPDATE productos SET nombre_p='$nombre_p', cantidad_p='$cantidad_p', precio_p='$precio_p', 
                   porcentaje_iva='$porcentaje_iva', id_categoria='$id_categoria', estado='$estado' 
                   WHERE id_producto='$id_producto'";

    if ($conn->query($sql_update) === TRUE) {
        echo "<div class='alert success'>Producto actualizado exitosamente.</div><br>";
    } else {
        echo "<div class='alert error'>Error al actualizar producto: " . $conn->error . "</div><br>";
    }
}

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="submit"],
        input[type="button"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"], input[type="button"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .alert {
            padding: 10px;
            margin: 10px 0;
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
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Gestionar Productos</h1>

    <!-- Formulario de Inserción -->
    <h2>Insertar Nuevo Producto</h2>
    <form method="post" action="">
        <label>Nombre del Producto:</label><input type="text" name="nombre_p" required>
        <label>Cantidad:</label><input type="number" name="cantidad_p" required>
        <label>Precio:</label><input type="number" step="0.01" name="precio_p" required>
        <label>Porcentaje de IVA:</label><input type="number" step="0.01" name="porcentaje_iva">
        <label>ID de Categoría:</label><input type="number" name="id_categoria">
        <label>Estado:</label><input type="text" name="estado">
        <input type="submit" name="insertar" value="Insertar Producto">
    </form>

    <!-- Formulario para Eliminar Productos -->
    <form method="post" action="">
        <h2>Productos Registrados</h2>
        <table>
            <tr>
                <th>Seleccionar</th>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Porcentaje IVA</th>
                <th>ID Categoría</th>
                <th>Estado</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='productos[]' value='" . $row["id_producto"] . "' onclick='toggleEditButton(this)'></td>";
                    echo "<td>" . $row["id_producto"] . "</td>";
                    echo "<td>" . $row["nombre_p"] . "</td>";
                    echo "<td>" . $row["cantidad_p"] . "</td>";
                    echo "<td>" . $row["precio_p"] . "</td>";
                    echo "<td>" . $row["porcentaje_iva"] . "</td>";
                    echo "<td>" . $row["id_categoria"] . "</td>";
                    echo "<td>" . $row["estado"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No hay productos registrados</td></tr>";
            }
            ?>
        </table>
        <br>
        <input type="submit" name="eliminar" value="Eliminar Producto">
        <input type="button" id="editButton" value="Editar Producto" onclick="editSelected()" disabled>
    </form>

    <!-- Formulario de Edición -->
    <div id="editForm" class="hidden">
        <h2>Editar Producto</h2>
        <form method="post" action="">
            <input type="hidden" id="editId" name="id_producto">
            <label>Nombre del Producto:</label><input type="text" id="editNombre" name="nombre_p" required>
            <label>Cantidad:</label><input type="number" id="editCantidad" name="cantidad_p" required>
            <label>Precio:</label><input type="number" step="0.01" id="editPrecio" name="precio_p" required>
            <label>Porcentaje de IVA:</label><input type="number" step="0.01" id="editPorcentaje" name="porcentaje_iva">
            <label>ID de Categoría:</label><input type="number" id="editCategoria" name="id_categoria">
            <label>Estado:</label><input type="text" id="editEstado" name="estado">
            <input type="submit" name="editar" value="Actualizar Producto">
        </form>
    </div>

    <script>
        function toggleEditButton(checkbox) {
            const editButton = document.getElementById('editButton');
            editButton.disabled = !checkbox.checked;
        }

        function editSelected() {
            const checkboxes = document.querySelectorAll('input[name="productos[]"]:checked');
            if (checkboxes.length === 1) {
                const row = checkboxes[0].closest('tr');
                document.getElementById('editId').value = row.cells[1].innerText;
                document.getElementById('editNombre').value = row.cells[2].innerText;
                document.getElementById('editCantidad').value = row.cells[3].innerText;
                document.getElementById('editPrecio').value = row.cells[4].innerText;
                document.getElementById('editPorcentaje').value = row.cells[5].innerText;
                document.getElementById('editCategoria').value = row.cells[6].innerText;
                document.getElementById('editEstado').value = row.cells[7].innerText;
                document.getElementById('editForm').classList.remove('hidden');
            } else {
                alert('Por favor selecciona un solo producto para editar.');
            }
        }
    </script>

</body>
</html>

<?php
$conn->close();
?>
    