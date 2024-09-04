<?php 

require '../../db_connection.php';
require '../../session.php';
require 'simple_consults.php';

$user_id = get_session_data();
$statistics = get_simple_statistics($conn, $user_id);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/reports.css">
</head>

<body>
    <?php include '../header.php'; ?>
    <div class="internal centrado">
        <div class="report-container">
            <div>
                <h3 class="gamer-title small-title">Reporte general de partidas</h3>
                <?php 
                for ($i = 0; $i < count($statistics); $i++) {
                    echo ''. $statistics[$i] . ' times <br>';
                }
                ?>
            </div>
            <hr class="divisor">
            <div>
                <form action="pets_rep.php" method="get">
                    <button type="submit" class="gamer-button">Ver reportes de mascotas</button>
                </form>
            </div>
            <div>
                <form action="depretators_rep.php" method="get">
                    <button class="gamer-button">Ver reportes de depredadores</button>
                </form>
            </div>
            <hr class="divisor">
            <div id="form-rep" class="gamer-form centrado gray-background">
                <form action="gold.php" method="POST">
                    <label for="init">Desde:</label>
                    <input type="date" id="init" name="init">

                    <label for="end">Hasta:</label>
                    <input type="date" id="end" name="end">

                    <button class="gamer-button">Consultar oro ganado</button>
                </form>
            </div>
            
        </div>
    </div>


</body>

</html>