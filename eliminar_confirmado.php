<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ejecutar la eliminación
    $sql = "DELETE FROM productos WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Producto eliminado correctamente');
            window.location = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al eliminar el producto');
            window.location = 'index.php';
        </script>";
    }
}
?>
