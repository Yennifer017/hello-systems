<?php

require '../db_connection.php';
require '../encryptation.php';
$error = '';
$mss = '';
$password_pattern = '/^[a-zA-Z0-9_@.,+\-*!?]+$/';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // datos del formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm_password'];
    //vaidaciones
    if($password != $confirmpassword) {
        $error = 'La contrasenas no coinciden';
    } else if(strlen($username) > 8){
        $error = 'El username deber ser menor a 8 caracteres';
    } else if(!preg_match($password_pattern, $password) || strlen($password) < 4) {
        $error = 'La contrasena no cumple con el formato establecido';
    } else {
        // Proteger contra inyecciones SQL
        $username = $conn->real_escape_string($username);
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        //encryptation
        $password = encrypt($password, $username);

        // Crear la consulta SQL de inserción
        $sql = "INSERT INTO Users (username, password, gold, email) 
                VALUES ('$username', '$password', 100, '$email')";
        try {
            // Ejecutar la consulta
            if ($conn->query($sql) === TRUE) {
                $mss = "Nuevo registro creado exitosamente";
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        } catch (mysqli_sql_exception $e) {
                $error = "". $e->getMessage();
        }
    }
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
    <div class="gamer-form div-centrado">
        <h2>Registro</h2>
        <form action="sign-up.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <?php
                if($mss != ''){
                    echo "<div class=\"success-message\"> ". $mss ."</div>";
                    $error = '';
                }

                if ($error != "") {
                    echo "<div class=\"error-message\">" . $error . "</div>";
                }
            ?>            

            <button type="submit">Registrarse</button>

            <div class="login-link">
                <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </div>
        </form>
    </div>
</body>

</html>