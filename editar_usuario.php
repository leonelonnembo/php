<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            color: #333;
            margin: 20px 0;
            font-size: 2rem;
        }

        /* Formulario */
        form {
            width: 60%;
            margin: 30px auto;
            padding: 25px;
            background-color: #ffffff;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
            font-size: 0.9rem;
            color: #555;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9f9f9;
        }

        input:focus {
            border-color: #17a2b8;
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(23, 162, 184, 0.5);
        }

        /* Botones */
        button {
            display: block;
            width: 100%;
            background-color: #17a2b8;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            text-transform: uppercase;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #138f9c;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        a {
            display: inline-block;
            margin: 20px auto;
            text-align: center;
            text-decoration: none;
            color: #17a2b8;
            font-weight: bold;
            transition: color 0.3s;
        }

        a:hover {
            color: #138f9c;
        }

        .success, .error {
            text-align: center;
            margin: 15px auto;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            color: #28a745;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .error {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            form {
                width: 90%;
                padding: 20px;
            }

            button {
                padding: 10px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
<?php
session_start();

if (!isset($_SESSION['client_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "<p class='error'>ID de usuario no especificado.</p>";
    echo '<a href="usuarios.php">Volver a la lista de usuarios</a>';
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM clientes WHERE id = $id";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 0) {
    echo "<p class='error'>Usuario no encontrado.</p>";
    echo '<a href="usuarios.php">Volver a la lista de usuarios</a>';
    exit();
}

$usuario = $resultado->fetch_assoc();
?>

<h1>Editar Usuario</h1>
<form method="POST" action="">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
    <label>Teléfono:</label>
    <input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>" required>
    <label>Dirección:</label>
    <input type="text" name="direccion" value="<?php echo $usuario['direccion']; ?>" required>
    <label>Contraseña (Dejar en blanco para no cambiar):</label>
    <input type="password" name="password">
    <button type="submit" name="actualizar">Actualizar Usuario</button>
</form>

<?php
if (isset($_POST['actualizar'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE clientes SET 
                    nombre = '$nombre', 
                    email = '$email', 
                    telefono = '$telefono', 
                    direccion = '$direccion', 
                    password = '$password_hash' 
                WHERE id = $id";
    } else {
        $sql = "UPDATE clientes SET 
                    nombre = '$nombre', 
                    email = '$email', 
                    telefono = '$telefono', 
                    direccion = '$direccion' 
                WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Usuario actualizado correctamente.</p>";
        header("Refresh:2; url=usuarios.php");
        exit();
    } else {
        echo "<p class='error'>Error al actualizar el usuario: " . $conn->error . "</p>";
    }
}
?>
<a href="usuarios.php">Volver a la lista de usuarios</a>
</body>
</html>
