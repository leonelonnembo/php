<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1rem;
            color: #555;
        }

        button {
            background-color: #17a2b8;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            margin: 10px;
            text-transform: uppercase;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        
        button[name="confirmar"] {
            background-color: #dc3545;
            color: #fff;
        }

        button[name="confirmar"]:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
        }

        button[name="cancelar"] {
            background-color: #17a2b8;
            color: #fff;
        }

        button[name="cancelar"]:hover {
            background-color: #138f9c;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(23, 162, 184, 0.2);
        }

        a {
            display: block;
            margin-top: 20px;
            font-size: 1rem;
            text-decoration: none;
            color: #17a2b8;
            font-weight: bold;
        }

        a:hover {
            color: #138f9c;
        }
    </style>
</head>
<body>
<?php
session_start();

// Verificar si el cliente está autenticado
if (!isset($_SESSION['client_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

// Verificar si se recibió un ID de producto por GET
if (!isset($_GET['id'])) {
    echo "<div class='container'><p>ID de producto no especificado.</p><a href='index.php'>Volver a la lista de productos</a></div>";
    exit();
}

$id = $_GET['id'];

// Obtener los datos del producto para confirmar
$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 0) {
    echo "<div class='container'><p>Producto no encontrado.</p><a href='index.php'>Volver a la lista de productos</a></div>";
    exit();
}

$producto = $resultado->fetch_assoc();

// Eliminar el producto si se confirmó
if (isset($_POST['confirmar'])) {
    $sql = "DELETE FROM productos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='container'><p>Producto eliminado correctamente.</p></div>";
        header("Refresh:2; url=index.php"); // Redirigir después de 2 segundos
        exit();
    } else {
        echo "<div class='container'><p>Error al eliminar el producto: " . $conn->error . "</p></div>";
    }
}

// Cancelar y regresar a la lista
if (isset($_POST['cancelar'])) {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <h1>Eliminar Producto</h1>
    <p>¿Estás seguro de que deseas eliminar el producto <strong><?php echo $producto['nombre']; ?></strong>?</p>
    <form method="POST">
        <button type="submit" name="confirmar">Sí, eliminar</button>
        <button type="submit" name="cancelar">Cancelar</button>
    </form>
    
</div>
</body>
</html>
