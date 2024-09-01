<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../db_connection.php';
require '../encryptation.php';
require '../session.php';

$error = '';
$mss = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    //proteger contra inyeccion SQL
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    //encryptation
    $password = encrypt($password, $username);
    
    try {
        //prepared statement
        $sql = "SELECT id FROM Users WHERE username = ? AND password = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Procesar los resultados
            $row = $result->fetch_assoc();
            setSessionCookie($row['id']);
            header("Location: display-pets.php");
            exit();

            /*while ($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"];
            }*/
        } else {
            $error = "Credenciales inválidas";
        }

    } catch (mysqli_sql_exception $e) {
        $error = "" . $e->getMessage();
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
        <h2>Inicio de sesión</h2>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <?php
                if ($error != "") {
                    echo "<div class=\"error-message\">" . $error . "</div>";
                }
            ?>  

            <button type="submit">Ingresar</button>

            <div class="login-link">
                <p>¿No tienes una cuenta? <a href="sign-up.php">Registrate aqui</a></p>
            </div>
        </form>

    </div>
</body>

</html>