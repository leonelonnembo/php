<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña

    // Verificar si el email ya está registrado
    $sql_check = "SELECT * FROM clientes WHERE email = '$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $error_message = "Este correo ya está registrado. Por favor, intenta con otro.";
    } else {
        // Registrar al nuevo cliente
        $sql = "INSERT INTO clientes (nombre, email, telefono, direccion, password) 
                VALUES ('$nombre', '$email', '$telefono', '$direccion', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            // Registro exitoso, redirigir al login
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        /* Reset general */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilo del body */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Contenedor del registro */
        .register-container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        /* Título del formulario */
        .register-container h1 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        /* Inputs del formulario */
        .register-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Botón de registro */
        .register-container button {
            width: 100%;
            padding: 10px;
            background-color:  #007BFF;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .register-container button:hover {
            background-color: #218838;
        }

        /* Enlace para login */
        .register-container p {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

        .register-container a {
            color: #007BFF;
            text-decoration: none;
        }

        .register-container a:hover {
            text-decoration: underline;
        }

        /* Mensaje de error */
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Registro de Usuario</h1>
        <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>
        <form action="registro.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Correo electrónico" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" placeholder="Número de teléfono" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" placeholder="Tu dirección" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Crea una contraseña" required>

            <button type="submit" name="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</body>
</html>
