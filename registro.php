<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña

    // Verificar si el email ya está registrado
    $sql_check = "SELECT * FROM clientes WHERE email = '$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "Este correo ya está registrado. Por favor, intenta con otro.";
    } else {
        // Registrar al nuevo cliente
        $sql = "INSERT INTO clientes (email, password) VALUES ('$email', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            // Registro exitoso, redirigir al login
            header("Location: login.php"); // Redirigir al login.php
            exit(); // Asegurarse de que el código posterior no se ejecute
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<form action="registro.php" method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="submit">Registrarse</button>
</form>

<p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
