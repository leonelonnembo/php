<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mostrar un mensaje de confirmación con JavaScript
    echo "<script>
        var confirmDelete = confirm('¿Estás seguro de que deseas eliminar este producto?');
        if (confirmDelete) {
            window.location = 'eliminar_confirmado.php?id=$id';
        } else {
            window.location = 'index.php';
        }
    </script>";
}
?>
