<?php 

require '../../db_connection.php';
require 'owned-animal.php';
require '../../session.php';

$error = '';
try {
    $id_session = get_session_data();

    $sql = "SELECT  Players_animals.id, Players_animals.exp, 
        Players_animals.level, Players_animals.atack, Players_animals.ps, Players_animals.alias, Animals.link_img
        FROM Players_animals
        JOIN Animals ON Players_animals.id_type = Animals.id
        WHERE Players_animals.id_owner = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_session);
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
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pet = new Owned_animal($row['id'], $row['exp'], $row['level'], 
                    $row['atack'], $row['ps'], $row['link_img'], $row['alias']);
                echo $pet->show_form();
            }
        } else {
            echo "<div class=\"internal centrado paragraph-gamer\">
                    <p> 
                        No posees ninguna mascota aun
                    </p>
                </div>";
        }
        ?>
    </div>

</body>
</html>