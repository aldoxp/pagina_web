<?php
// Conexión a la base de datos
$host = "localhost";
$dbname = "paperworld";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el producto con id = 2
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id_producto = :id_producto");
    $stmt->execute(['id_producto' => 2]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    // Procesar la compra si el formulario es enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cantidad_comprar = $_POST["cantidad_comprar"];

        if ($cantidad_comprar > 0 && $cantidad_comprar <= $producto["cantidad_p"]) {
            // Actualizar la cantidad del producto en la base de datos
            $stmt_update = $conn->prepare("UPDATE productos SET cantidad_p = cantidad_p - :cantidad WHERE id_producto = :id_producto");
            $stmt_update->execute(['cantidad' => $cantidad_comprar, 'id_producto' => 2]);

            // Reflejar el cambio en la página recargando la información del producto
            $stmt->execute(['id_producto' => 2]);
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "<p class='success'>Compra realizada con éxito. Stock actualizado.</p>";
        } else {
            echo "<p class='error'>Error: cantidad no válida.</p>";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f5f5;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            text-align: center;
        }
        .product-image {
            width: 100%;
            height: auto;
            max-height: 200px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        h1 {
            font-size: 24px;
            color: #333;
        }
        .product-details p {
            margin: 8px 0;
            color: #555;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
        .success {
            color: green;
            margin-top: 10px;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles del Producto</h1>

        <?php if ($producto): ?>
            <!-- Imagen del producto -->
            <img src="Imagenes/libreta1.jpg" alt="Imagen" class="product-image">

            <div class="product-details">
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($producto['nombre_p']); ?></p>
                <p><strong>Cantidad disponible:</strong> <?php echo htmlspecialchars($producto['cantidad_p']); ?></p>
                <p><strong>Precio:</strong> $<?php echo htmlspecialchars($producto['precio_p']); ?></p>
                <p><strong>IVA:</strong> <?php echo htmlspecialchars($producto['porcentaje_iva']); ?>%</p>
                <p><strong>Estado:</strong> <?php echo htmlspecialchars($producto['estado']); ?></p>
            </div>

            <!-- Formulario para comprar el producto -->
            <form method="post" action="">
                <label for="cantidad_comprar">Cantidad a comprar:</label>
                <input type="number" name="cantidad_comprar" id="cantidad_comprar" min="1" max="<?php echo htmlspecialchars($producto['cantidad_p']); ?>" required>
                <button type="submit">Comprar</button>
                <a href="aplicacion.php">Regresar</a>
            </form>
        <?php else: ?>
            <p>Producto no encontrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>
