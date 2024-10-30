<?php
session_start();

// Verifica si el usuario ya ha iniciado sesión
if (isset($_SESSION['user'])) {
    $role = $_SESSION['role'];
    if ($role == 'usuario') {
        header("Location: aplicacion.php");
    } elseif ($role == 'empleado' || $role == 'admin') {
        header("Location: aplicacion_administracion.php");
    }
    exit();
}

// Mensaje de error si el inicio de sesión falla
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aquí debes verificar el usuario y la contraseña
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Obtener el rol seleccionado

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

    // Consulta para verificar el usuario y la contraseña
    $sql = "SELECT * FROM usuarios WHERE Username_U = ? AND Contraseña = ? AND Rol = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row['Username_U']; // Guarda el nombre de usuario en la sesión
        $_SESSION['role'] = $row['Rol']; // Guarda el rol en la sesión

        // Redirección según el rol
        if ($row['Rol'] == 'usuario') {
            header("Location: aplicacion.php");
        } elseif ($row['Rol'] == 'empleado' || $row['Rol'] == 'admin') {
            header("Location: aplicacion_administracion.php");
        }
        exit();
    } else {
        $error = 'Usuario o contraseña incorrectos.';
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
    <title>Iniciar sesión - Papelería Kathy</title>
    <style>
        /* Aquí está el estilo CSS que me proporcionaste */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            margin: 0;
        }

        .login-container {
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

        input {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .login-btn {
            background-color: #ff4081;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-btn:hover {
            background-color: #e0356f;
        }

        .social-login {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        .social-btn {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .google {
            background-color: #db4437;
            color: white;
        }

        .microsoft {
            background-color: #00a4ef;
            color: white;
        }

        .apple {
            background-color: #000;
            color: white;
        }

        .social-btn img {
            width: 20px;
            height: 20px;
        }

        a {
            text-decoration: none;
            color: #ff4081;
        }

        a:hover {
            text-decoration: underline;
        }

        .forgot-password {
            margin-top: 10px;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="Imagenes/Logopapeleria.png" alt="Papelería Kathy">
        </div>
        <h2>Iniciar sesión</h2>
        <p>¿Es tu primera vez aquí? <a href="aplicacion_registro.php">Regístrate</a></p>

        <form action="aplicacion_iniciosesion.php" method="POST">
            <label for="usuario">Usuario</label>
            <input type="text" id="username" name="username" placeholder="user" required>

            <label for="password">Contraseña*</label>
            <input type="password" id="password" name="password" placeholder="****" required>

            <label for="role">Selecciona el rol:</label>
                        <select id="role" name="role" required>
                        <option value="usuario">usuario</option>
                            <option value="admin">admin</option>
                            <option value="empleado">empleado</option>
                        </select>

            <div class="forgot-password">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>

            

            <button type="submit" class="login-btn" name="login">Ingresar</button>
        </form>

        <p>O conéctate con</p>
        <div class="social-login">
            <button class="social-btn google">
                <img src="Imagenes_Sesion/google.png" alt="Google Logo"> Continuar con Google
            </button>
            <button class="social-btn microsoft">
                <img src="Imagenes_Sesion/microsoft.png" alt="Microsoft Logo"> Continuar con Microsoft
            </button>
            <button class="social-btn apple">
                <img src="Imagenes_Sesion/manzana(1).png" alt="Apple Logo"> Continuar con Apple
            </button>
        </div>
    </div>

</body>
</html>