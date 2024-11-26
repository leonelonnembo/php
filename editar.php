<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos - Editar</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Encabezado */
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

        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9f9f9;
        }

        input:focus, textarea:focus {
            border-color: #17a2b8;
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(23, 162, 184, 0.5);
        }

        textarea {
            height: 120px;
        }

        /* Botones */
        button {
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

        .success, .error {
            text-align: center;
            margin: 15px auto;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            color: #28a745;
            font-weight: bold;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .error {
            color: #dc3545;
            font-weight: bold;
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
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>

        <button type="submit" name="actualizar">Actualizar</button>
    </form>

    <?php
    if (isset($_POST['actualizar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='success'>Producto actualizado correctamente</div>";
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='error'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</body>
</html>
