<?php 
require '../../db_connection.php';
require 'owned-animal.php';

try { //getAnimalsOnSale
    $sql = "SELECT * FROM Animals"; /*TODO: show the owned-pets*/ 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

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
        Establo de mascotas
    </h1>
</body>
</html>