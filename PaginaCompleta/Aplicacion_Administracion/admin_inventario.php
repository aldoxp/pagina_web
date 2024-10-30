<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario Proveedor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
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
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        form {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="number"], select {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Inventario de Proveedores</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Proveedor</th>
            <th>Usuario</th>
            <th>Cantidad Comprada</th>
            <th>Precio Unitario</th>
        </tr>
        <?php
        try {
            // Conexión a la base de datos
            $pdo = new PDO('mysql:host=localhost;dbname=paperworld', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta para obtener los datos de inventario con nombres
            $query = "
                SELECT 
                    inv.id_inv,
                    prod.nombre_p AS producto,
                    prov.nombre_proveedor AS proveedor,
                    usu.Nombre_U AS usuario,
                    inv.cantidad_comprada,
                    inv.precio_U
                FROM 
                    inventariado_proveedor inv
                JOIN 
                    productos prod ON inv.id_producto = prod.id_producto
                JOIN 
                    proveedores prov ON inv.id_proveedor = prov.id_proveedor
                JOIN 
                    usuarios usu ON inv.id_usuario = usu.id_usuario
            ";

            // Ejecutar la consulta
            $stmt = $pdo->query($query);

            // Mostrar los resultados en la tabla
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id_inv']) . "</td>";
                echo "<td>" . htmlspecialchars($row['producto']) . "</td>";
                echo "<td>" . htmlspecialchars($row['proveedor']) . "</td>";
                echo "<td>" . htmlspecialchars($row['usuario']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cantidad_comprada']) . "</td>";
                echo "<td>" . htmlspecialchars($row['precio_U']) . "</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </table>

    <h2>Insertar Nuevo Registro</h2>
    <form action="insertar.php" method="post">
        <label for="id_producto">ID Producto:</label>
        <input type="number" name="id_producto" required>

        <label for="id_proveedor">ID Proveedor:</label>
        <input type="number" name="id_proveedor" required>

        <label for="id_usuario">ID Usuario:</label>
        <input type="number" name="id_usuario" required>

        <label for="cantidad_comprada">Cantidad Comprada:</label>
        <input type="number" name="cantidad_comprada" required>

        <label for="precio_U">Precio Unitario:</label>
        <input type="number" name="precio_U" step="0.01" required>

        <button type="submit">Insertar</button>
    </form>

    <h2>Actualizar Registro</h2>
    <form action="actualizar.php" method="post">
        <label for="id_inv">ID Inventario:</label>
        <input type="number" name="id_inv" required>

        <label for="cantidad_comprada">Nueva Cantidad Comprada:</label>
        <input type="number" name="cantidad_comprada" required>

        <label for="precio_U">Nuevo Precio Unitario:</label>
        <input type="number" name="precio_U" step="0.01" required>

        <button type="submit">Actualizar</button>
    </form>

    <h2>Eliminar Registro</h2>
    <form action="eliminar.php" method="post">
        <label for="id_inv_eliminar">ID Inventario a Eliminar:</label>
        <input type="number" name="id_inv" required>

        <button type="submit">Eliminar</button>
    </form>
</body>
</html>
