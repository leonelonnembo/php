<?php
session_start();
include 'db.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM clientes WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $client = $result->fetch_assoc();
        if (password_verify($password, $client['password'])) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['client_id'] = $client['id'];
            $_SESSION['email'] = $client['email'];
            header("Location: index.php"); // Redirigir al CRUD o a la página principal
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Cliente no encontrado.";
    }
}
?>

<form action="login.php" method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="submit">Login</button>
</form>

<p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
