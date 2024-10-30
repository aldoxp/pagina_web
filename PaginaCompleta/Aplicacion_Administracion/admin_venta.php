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

// Consulta para obtener los datos de la tabla de ventas, uniendo con productos y usuarios
$sql = "
    SELECT v.id_venta, p.nombre_p AS nombre_producto, u.Username_U AS nombre_usuario, 
           v.cantidad, v.precio_U, v.descuento, v.total_pago 
    FROM venta v
    LEFT JOIN productos p ON v.id_producto = p.id_producto
    LEFT JOIN usuarios u ON v.id_usuario = u.id_usuario
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .alert {
            padding: 10px;
            background-color: #f9f9f9;
            margin: 20px 0;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Registro de Ventas</h1>

    <table>
        <tr>
            <th>ID Venta</th>
            <th>Nombre Producto</th>
            <th>Nombre Usuario</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Descuento</th>
            <th>Total a Pagar</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_venta"] . "</td>";
                echo "<td>" . $row["nombre_producto"] . "</td>";
                echo "<td>" . $row["nombre_usuario"] . "</td>";
                echo "<td>" . $row["cantidad"] . "</td>";
                echo "<td>" . number_format($row["precio_U"], 2) . "</td>";
                echo "<td>" . number_format($row["descuento"], 2) . "</td>";
                echo "<td>" . number_format($row["total_pago"], 2) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay ventas registradas</td></tr>";
        }
        ?>
    </table>

    <?php
    $conn->close();
    ?>
</body>
</html>
