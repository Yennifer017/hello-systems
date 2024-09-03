<?php
require '../../db_connection.php';
require 'animal-on-sale.php';
require 'economic.php';

try { //getAnimalsOnSale
    $sql = "SELECT * FROM Animals";
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
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $animal = new Animal_on_sale($row['id'], $row['cost'], $row['atk_base'], 
                            $row['ps_base'], $row['link_img'], $row['def_name']);
                echo $animal->show_form();
            }
        } else {
            $error = "No se han encontrado animales en venta";
        }
        ?>

    </div>

</body>

</html>