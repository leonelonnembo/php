<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
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

        /* Contenedor principal */
        .container {
            width: 60%;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .container p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 20px;
        }

        .container strong {
            color: #000;
        }

        /* Botones */
        button {
            margin: 10px;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
            transition: all 0.3s ease;
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

        /* Link volver */
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #17a2b8;
            font-weight: bold;
            transition: color 0.2s ease;
        }

        a:hover {
            color: #138f9c;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
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

// Verificar si se recibió un ID de usuario por GET
if (!isset($_GET['id'])) {
    echo "<div class='container'><p>ID de usuario no especificado.</p><a href='usuarios.php'>Volver a la lista de usuarios</a></div>";
    exit();
}

$id = $_GET['id'];

// Obtener los datos del usuario para confirmar
$sql = "SELECT * FROM clientes WHERE id = $id";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 0) {
    echo "<div class='container'><p>Usuario no encontrado.</p><a href='usuarios.php'>Volver a la lista de usuarios</a></div>";
    exit();
}

$usuario = $resultado->fetch_assoc();

// Eliminar el usuario si se confirmó
if (isset($_POST['confirmar'])) {
    $sql = "DELETE FROM clientes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='container'><p>Usuario eliminado correctamente.</p></div>";
        header("Refresh:2; url=usuarios.php"); // Redirigir después de 2 segundos
        exit();
    } else {
        echo "<div class='container'><p>Error al eliminar el usuario: " . $conn->error . "</p></div>";
    }
}

// Cancelar y regresar a la lista
if (isset($_POST['cancelar'])) {
    header("Location: usuarios.php");
    exit();
}
?>

<div class="container">
    <h1>Eliminar Usuario</h1>
    <p>¿Estás seguro de que deseas eliminar al usuario <strong><?php echo $usuario['nombre']; ?></strong>?</p>
    <form method="POST">
        <button type="submit" name="confirmar">Sí, eliminar</button>
        <button type="submit" name="cancelar">Cancelar</button>
    </form>
    <a href="usuarios.php">Volver a la lista de usuarios</a>
</div>
</body>
</html>
