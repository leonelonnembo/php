<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php
session_start();

// Verificar si el cliente está autenticado
if (!isset($_SESSION['client_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

// Verificar si se recibió un ID de usuario por GET
if (!isset($_GET['id'])) {
    echo "<p>ID de usuario no especificado.</p>";
    echo '<a href="usuarios.php">Volver a la lista de usuarios</a>';
    exit();
}

$id = $_GET['id'];

// Obtener los datos actuales del usuario
$sql = "SELECT * FROM clientes WHERE id = $id";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 0) {
    echo "<p>Usuario no encontrado.</p>";
    echo '<a href="usuarios.php">Volver a la lista de usuarios</a>';
    exit();
}

$usuario = $resultado->fetch_assoc();
?>

<h1>Editar Usuario</h1>
<form method="POST" action="">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
    <br>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
    <br>
    <label>Teléfono:</label>
    <input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>" required>
    <br>
    <label>Dirección:</label>
    <input type="text" name="direccion" value="<?php echo $usuario['direccion']; ?>" required>
    <br>
    <label>Contraseña (Dejar en blanco para no cambiar):</label>
    <input type="password" name="password">
    <br><br>
    <button type="submit" name="actualizar">Actualizar Usuario</button>
</form>

<?php
if (isset($_POST['actualizar'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $password = $_POST['password'];

    // Construir la consulta de actualización
    if (!empty($password)) {
        // Si se proporcionó una nueva contraseña, también se actualiza
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE clientes SET 
                    nombre = '$nombre', 
                    email = '$email', 
                    telefono = '$telefono', 
                    direccion = '$direccion', 
                    password = '$password_hash' 
                WHERE id = $id";
    } else {
        // Si no se proporcionó contraseña, se actualizan solo los otros campos
        $sql = "UPDATE clientes SET 
                    nombre = '$nombre', 
                    email = '$email', 
                    telefono = '$telefono', 
                    direccion = '$direccion' 
                WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<p>Usuario actualizado correctamente.</p>";
        header("Refresh:2; url=usuarios.php"); // Redirigir a la lista de usuarios después de 2 segundos
        exit();
    } else {
        echo "<p>Error al actualizar el usuario: " . $conn->error . "</p>";
    }
}
?>
<a href="usuarios.php">Volver a la lista de usuarios</a>
</body>
</html>
