<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Productos</title>
     <style>
        /* Estilos generales */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa; /* Mismo color de fondo */
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

/* Encabezado */
h1 {
    text-align: center;
    color: #333; /* Mismo tono de texto */
    margin: 20px 0;
    font-size: 2rem; /* Tamaño consistente */
}

/* Formulario */
form {
    width: 60%; /* Ancho consistente */
    margin: 30px auto;
    padding: 25px;
    background-color: #ffffff;
    border: 1px solid #e1e1e1; /* Mismo color de bordes */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

label {
    font-weight: bold;
    margin-bottom: 10px;
    display: block;
    font-size: 0.9rem;
    color: #555; /* Color consistente */
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
    border-color: #17a2b8; /* Mismo color azul */
    outline: none;
    background-color: #fff;
    box-shadow: 0 0 5px rgba(23, 162, 184, 0.5);
}

textarea {
    height: 120px; /* Consistencia en la altura */
}

/* Botones */
button {
    background-color: #17a2b8; /* Mismo color azul */
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
    background-color: #138f9c; /* Mismo color de hover */
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Mensajes */
.success, .error {
    text-align: center;
    margin: 15px auto;
    padding: 10px;
    border-radius: 5px;
}

.success {
    color: #28a745; /* Mismo verde */
    font-weight: bold;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
}

.error {
    color: #dc3545; /* Mismo rojo */
    font-weight: bold;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
}

/* Enlace */
a {
    display: block;
    text-align: center;
    margin: 20px auto;
    font-size: 1rem;
    text-decoration: none;
    color: #17a2b8; /* Azul consistente */
    font-weight: bold;
    transition: color 0.3s ease;
}

a:hover {
    color: #138f9c; /* Mismo azul oscuro */
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
    <a href="index.php">Volver</a>
</body>
</html>
