<?php 

require '../../db_connection.php';
require 'animal.php';
require '../../session.php';
require 'animalDB.php';

$error = '';
try {
    $id_session = get_session_data();
    $animals = get_players($conn, $id_session);

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
    <link rel="stylesheet" href="../../styles/cards.css">
</head>
<body>
    <?php include '../header.php'; ?> 
    <h1 class="gamer-title">
        Establo de mascotas
    </h1>

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
            echo "<div class=\"internal centrado paragraph-gamer\">
                    <p> 
                        No posees ninguna mascota aun
                    </p>
                </div>";
        } else {
            for ($i = 0; $i < count($animals); $i++) {
                echo $animals[$i]->show_form();
            }
        }

        ?>
    </div>

</body>
</html>