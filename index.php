<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Productos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php
session_start();

// Verificar si el cliente está autenticado
if (!isset($_SESSION['client_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

// Código para el CRUD de productos
?>

<h2>Bienvenido, <?php echo $_SESSION['email']; ?></h2>

<h1>Lista de Productos</h1>
<a href="usuarios.php" style="margin-right: 15px;">Ver Usuarios</a>
<a href="crear.php">Agregar Nuevo Producto</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Descripción</th>
        <th>Acciones</th>
    </tr>

    <?php
    $sql = "SELECT * FROM productos";
    $resultado = $conn->query($sql);

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$fila['id']}</td>";
        echo "<td>{$fila['nombre']}</td>";
        echo "<td>{$fila['precio']}</td>";
        echo "<td>{$fila['descripcion']}</td>";
        echo "<td>
                <a href='editar.php?id={$fila['id']}'>Editar</a> |
                <a href='eliminar.php?id={$fila['id']}'>Eliminar</a>
              </td>";
        echo "</tr>";
    }
    ?>
</table>
<a href="logout.php">Cerrar sesión</a>
</body>
</html>
