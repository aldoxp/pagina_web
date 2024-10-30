<?php
// Iniciar la sesión
session_start();

// Mensajes de éxito y error
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $password = $_POST['password'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $role = $_POST['role'];

    // Conectar a la base de datos
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "paperworld";

    // Crear conexión
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (Username_U, Nombre_U, Apellidos_U, Contraseña, Direccion_U, Telefono_U, Correo, Rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $username, $nombre, $apellidos, $password, $direccion, $telefono, $correo, $role);

    if ($stmt->execute()) {
        $success = "Usuario registrado exitosamente.";
    } else {
        $error = "Error al registrar el usuario.";
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario - Papelería Kathy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            margin: 0;
        }

        .register-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo img {
            width: 150px;
            margin-bottom: 20px;
        }

        h2 {
            color: #ff4081;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-size: 14px;
            color: #333;
        }

        input, select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .register-btn {
            background-color: #ff4081;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .register-btn:hover {
            background-color: #e0356f;
        }

        .message {
            margin-top: 10px;
            font-size: 14px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo">
            <img src="Imagenes/Logopapeleria.png" alt="Papelería Kathy">
        </div>
        <h2>Registrar Usuario</h2>
        <form action="aplicacion_registro.php" method="POST">
            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" placeholder="Nombre de Usuario" required>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>

            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Contraseña" required>

            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" placeholder="Dirección">

            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" placeholder="Teléfono">

            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" placeholder="Correo">

            <label for="role">Selecciona el Rol</label>
            <select id="role" name="role" required>
                <option value="admin">usuario</option>
            </select>

            <button type="submit" class="register-btn">Registrar</button>

            <a href="aplicacion_iniciosesion.php">Regresar al inicio</a>
        </form>

        <!-- Mostrar mensajes de éxito o error -->
        <?php if ($success): ?>
            <p class="message success"><?php echo $success; ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p class="message error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
