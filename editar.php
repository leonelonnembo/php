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
    <h1>Editar Producto</h1>

    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $resultado = $conn->query($sql);
    $producto = $resultado->fetch_assoc();
    ?>

    <form method="POST" action="editar.php?id=<?php echo $id; ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
        <br>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required>
        <br>
        <label>Descripción:</label>
        <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
        <br>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>

    <?php
    if (isset($_POST['actualizar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Producto actualizado correctamente";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
</body>
</html>
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
    <h1>Editar Producto</h1>

    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $resultado = $conn->query($sql);
    $producto = $resultado->fetch_assoc();
    ?>

    <form method="POST" action="editar.php?id=<?php echo $id; ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
        <br>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required>
        <br>
        <label>Descripción:</label>
        <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
        <br>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>

    <?php
    if (isset($_POST['actualizar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Producto actualizado correctamente";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
</body>
</html>
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
    <h1>Editar Producto</h1>

    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $resultado = $conn->query($sql);
    $producto = $resultado->fetch_assoc();
    ?>

    <form method="POST" action="editar.php?id=<?php echo $id; ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
        <br>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required>
        <br>
        <label>Descripción:</label>
        <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
        <br>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>

    <?php
    if (isset($_POST['actualizar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Producto actualizado correctamente";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
</body>
</html>
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
    <h1>Editar Producto</h1>

    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $resultado = $conn->query($sql);
    $producto = $resultado->fetch_assoc();
    ?>

    <form method="POST" action="editar.php?id=<?php echo $id; ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
        <br>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required>
        <br>
        <label>Descripción:</label>
        <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
        <br>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>

    <?php
    if (isset($_POST['actualizar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Producto actualizado correctamente";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
</body>
</html>
