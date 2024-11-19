<?php
$servidor = "sql210.infinityfree.com";
$usuario = "if0_37717027";
$password = "Leoloco130199";
$base_datos = "if0_37717027_api_curso_php";

$conn = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
