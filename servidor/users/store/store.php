<?php 
    require '../../db_connection.php';
    require '../../session.php';

    try {
        //prepared statement
        $sql = "SELECT * FROM Animals";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Procesar los resultados
            $row = $result->fetch_assoc();
            while ($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"] . "<br>";
            }
        } else {
            $error = "Credenciales inválidas";
        }

    } catch (mysqli_sql_exception $e) {
        $error = "" . $e->getMessage();
    }


    try {
        //prepared statement
        $sql = "SELECT * FROM Animals";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Procesar los resultados
            $row = $result->fetch_assoc();
            while ($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"];
            }
        } else {
            $error = "Credenciales inválidas";
        }

    } catch (mysqli_sql_exception $e) {
        $error = "" . $e->getMessage();
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../styles/styles.css">
</head>
<body>
    <?php include '../header.php'; ?> 

    <h1 class="gamer-title">
        Tienda de Mascotas
    </h1>
</body>
</html>