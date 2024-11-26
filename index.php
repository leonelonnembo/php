<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Productos</title>
 <style>
 /* Estilos generales */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

/* Encabezados */
h1, h2 {
    text-align: center;
    color: #333;
    margin: 20px 0;
}

h1 {
    font-size: 2rem;
}

h2 {
    font-size: 1.5rem;
    color: #555;
}

/* Enlaces de navegación */
a {
    text-decoration: none;
    font-size: 1rem;
    color: #17a2b8;
    font-weight: bold;
    margin: 10px;
    padding: 8px 12px;
    border: 1px solid #17a2b8;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

a:hover {
    background-color: #17a2b8;
    color: white;
}

/* Tabla */
table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: white;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 15px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #17a2b8;
    color: white;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 0.9rem;
}

td {
    font-size: 0.9rem;
    color: #555;
}

tr:nth-child(even) {
    background-color: #f8f9fa;
}

tr:hover {
    background-color: #e9ecef;
}

/* Botones dentro de la tabla */
td a {
    font-size: 0.9rem;
    color: #17a2b8;
    text-decoration: underline;
    margin: 0 5px;
    transition: color 0.3s;
}

td a:hover {
    color: #138f9c;
    text-decoration: none;
}

/* Botón de cerrar sesión */
a[href='logout.php'] {
    display: block;
    text-align: center;
    max-width: 150px;
    margin: 20px auto;
    background-color: #dc3545;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s;
}

a[href='logout.php']:hover {
    background-color: #c82333;
}

/* Responsive */
@media (max-width: 768px) {
    table {
        font-size: 0.8rem;
    }

    th, td {
        padding: 10px;
    }

    a {
        font-size: 0.9rem;
        padding: 5px 10px;
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

// Código para el CRUD de productos
?>

<h2>Bienvenido, <?php echo $_SESSION['nombre']; ?></h2>


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
