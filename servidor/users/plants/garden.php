<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../../db_connection.php';
require '../store/economic.php';
require 'plantDB.php';
require 'Plant.php';
$error = '';
try { //getAnimalsOnSale'
    $id_user = get_session_data();
    $gold = get_gold($conn, $id_user);
    if($gold < 0) {
        $error = "No se ha podido obtener el oro";
    }
    $plants = get_plants($conn);


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
    <link rel="stylesheet" href="../../styles/store-styles.css">
    <link rel="stylesheet" href="../../styles/cards.css">
</head>

<body>
    <?php include '../header.php'; ?>

    <h1 class="gamer-title">
        Jardin de plantas
    </h1>

    <div class="gold-container centrado">
        <img src="../../img/icons/coin.png" alt="Gold Icon" class="gold-icon">
        <div class="centrado">
            <span class="gold-amount animated"> <?php echo $gold ?> </span>
        </div>
    </div>

    <div class="internal centrado">
        <?php
        if ($error != "") {
            echo "<div class=\"error-message\">" . $error . "</div>";
        }
        ?>
    </div>

    <div class="internal centrado">
        <?php
        if(count($plants) == 0) {
            echo "<div class=\"error-message\"> No se han podido obtener las plantas a la venta </div>";
        } else {
            for ($i = 0; $i < count($plants); $i++) {
                echo $plants[$i]->show_form();
            }
        }
        
        ?>
    </div>

</body>

</html>