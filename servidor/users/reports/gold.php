<?php
require '../../db_connection.php';
require '../../session.php';
require 'simple_consults.php';

try {
    $id_user = get_session_data();

    $init = $_POST['init'];
    if($init == '' ||$init == null){
        $init = '1000-01-01';
    }
    $end = $_POST['end'];
    if($end == '' || $end == null){
        $end = '9999-01-01';
    }

    $gold = get_total_gold($conn, $id_user, $init, $end);
    if($gold < 0) {
        $error = "No se ha podido obtener el oro";
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
    <link rel="stylesheet" href="../../styles/store-styles.css">
</head>

<body>
    <?php include '../header.php'; ?>

    <h1 class="gamer-title">
        Oro Obtenido
    </h1>
    <div class="centrado internal green-paragraph">
        <p>
            Desde: <?php echo $init?> -- Hasta: <?php echo $end?>
        </p>
    </div>
    <div class="gold-container centrado" id = "big-gold-container">
        <img src="../../img/icons/coin.png" alt="Gold Icon" class="big-gold-icon">
        <div class="centrado">
            <span class="gold-amount animated big-gold"> <?php echo $gold ?> </span>
        </div>
    </div>

    <div class="internal centrado">
        <?php
        if ($error != "") {
            echo "<div class=\"error-message\">" . $error . "</div>";
        }
        ?>
    </div>
</body>

</html>