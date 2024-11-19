<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Usuarios</title>
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

// Código para el CRUD de usuarios
?>

<h2>Bienvenido, <?php echo $_SESSION['email']; ?></h2>
<h1>Lista de Usuarios</h1>
<a href="productos.php" style="margin-right: 15px;">Ver Productos</a>
<a href="crear_usuario.php">Agregar Nuevo Usuario</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Contraseñas</th>
        <th>Acciones</th>
    </tr>

    <?php
    $sql = "SELECT id, nombre, email, telefono, direccion, password FROM clientes";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$fila['id']}</td>";
            echo "<td>{$fila['nombre']}</td>";
            echo "<td>{$fila['email']}</td>";
            echo "<td>{$fila['telefono']}</td>";
            echo "<td>{$fila['direccion']}</td>";
            echo "<td>{$fila['password']}</td>";
            echo "<td>
                    <a href='editar_usuario.php?id={$fila['id']}'>Editar</a> |
                    <a href='eliminar_usuario.php?id={$fila['id']}'>Eliminar</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No se encontraron usuarios.</td></tr>";
    }
    ?>
</table>
<a href="logout.php">Cerrar sesión</a>
</body>
</html>
