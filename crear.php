<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Productos</title>
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
?>
    <h1>Agregar Nuevo Producto</h1>
    <form method="POST" action="crear.php">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" required>
        <br>
        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea>
        <br>
        <button type="submit" name="agregar">Agregar</button>
    </form>

    <?php
    if (isset($_POST['agregar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        $sql = "INSERT INTO productos (nombre, precio, descripcion) VALUES ('$nombre', '$precio', '$descripcion')";
        if ($conn->query($sql) === TRUE) {
            echo "Producto agregado correctamente";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
</body>
</html>
