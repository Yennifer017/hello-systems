<?php
require '../../db_connection.php';
require 'animal-on-sale.php';
require 'economic.php';
require 'animalSaleDB.php';

try { //getAnimalsOnSale'
    $id_user = get_session_data();
    $gold = get_gold($conn, $id_user);
    if($gold < 0) {
        $error = "No se ha podido obtener el oro";
    }

    $animals = get_animals($conn);

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
        Tienda de Mascotas
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
        if(count($animals) == 0){
            echo "<div class=\"error-message\"> No se han podido obtener los animales a la venta </div>";
        } else {
            for ($i = 0; $i < 10; $i++) {
                echo $animals[$i]->show_form();
            }
        }
        
        ?>

    </div>

</body>

</html>