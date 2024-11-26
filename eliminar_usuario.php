<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
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

// Obtener los datos del usuario para confirmar
$sql = "SELECT * FROM clientes WHERE id = $id";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 0) {
    echo "<p>Usuario no encontrado.</p>";
    echo '<a href="usuarios.php">Volver a la lista de usuarios</a>';
    exit();
}

$usuario = $resultado->fetch_assoc();

// Eliminar el usuario si se confirmó
if (isset($_POST['confirmar'])) {
    $sql = "DELETE FROM clientes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Usuario eliminado correctamente.</p>";
        header("Refresh:2; url=usuarios.php"); // Redirigir después de 2 segundos
        exit();
    } else {
        echo "<p>Error al eliminar el usuario: " . $conn->error . "</p>";
    }
}

// Cancelar y regresar a la lista
if (isset($_POST['cancelar'])) {
    header("Location: usuarios.php");
    exit();
}
?>

<h1>Eliminar Usuario</h1>
<p>¿Estás seguro de que deseas eliminar al usuario <strong><?php echo $usuario['nombre']; ?></strong>?</p>

<form method="POST">
    <button type="submit" name="confirmar">Sí, eliminar</button>
    <button type="submit" name="cancelar">Cancelar</button>
</form>

<a href="usuarios.php">Volver a la lista de usuarios</a>
</body>
</html>
