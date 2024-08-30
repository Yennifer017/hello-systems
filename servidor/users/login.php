<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
    <div class="gamer-form div-centrado">
        <h2>Inicio de sesión</h2>
        <form action="procesar_registro.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Ingresar</button>

            <div class="login-link">
                <p>¿No tienes una cuenta? <a href="sign-up.php">Registrate aqui</a></p>
            </div>
        </form>
    </div>
</body>

</html>
