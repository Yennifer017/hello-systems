<?php 

require '../../db_connection.php';
require '../../session.php';
require 'pet_consults.php';

$id_user = get_session_data();
$rentable_pets = get_most_rentable_pets($conn, $id_user);
$mpoints_pets = get_most_gained_pets($conn, $id_user);
$level_pets = get_most_level_pets($conn, $id_user);
$moreu_pets = get_most_used_pets($conn, $id_user);

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
                <h3 class="gamer-title small-title">Top 5 Mascotas mas usadas</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>Alias</th>
                            <th>Total de combates</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                        for ($i = 0; $i < count($moreu_pets); $i++) {
                            $uses= $moreu_pets[$i]->level;
                            $alias = $moreu_pets[$i]->alias;
                            $puesto = $i + 1;
                            echo "<tr>
                                    <td>
                                        $puesto
                                    </td>
                                    <td>
                                        $alias
                                    </td>
                                    <td>    
                                        $uses
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <hr class="divisor">
            <div>
                <h3 class="gamer-title small-title">Top 5 mascotas de nivel mas alto</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>Alias</th>
                            <th>Nivel</th>
                            <th>Experiencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                        for ($i = 0; $i < count($level_pets); $i++) {
                            $level = $level_pets[$i]->level;
                            $exp = $level_pets[$i]->exp;
                            $alias = $level_pets[$i]->alias;
                            $puesto = $i + 1;
                            echo "<tr>
                                    <td>
                                        $puesto
                                    </td>
                                    <td>
                                        $alias
                                    </td>
                                    <td>    
                                        $level
                                    </td>
                                    <td>    
                                        $exp
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <hr class="divisor">
            <div>
                <h3 class="gamer-title small-title">Top 5 mascotas que mas puntos han ganado</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>Alias</th>
                            <th>Puntos acumulados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                        for ($i = 0; $i < count($mpoints_pets); $i++) {
                            $points_gained = $mpoints_pets[$i]->level;
                            $alias = $mpoints_pets[$i]->alias;
                            $puesto = $i + 1;
                            echo "<tr>
                                    <td>
                                        $puesto
                                    </td>
                                    <td>
                                        $alias
                                    </td>
                                    <td>    
                                        $points_gained 
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <hr class="divisor">
            <div>
                <h3 class="gamer-title small-title">Top 5 mascotas que mas oro han ganado</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>Alias</th>
                            <th>Oro conseguido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                        for ($i = 0; $i < count($rentable_pets); $i++) {
                            $gold_gained = $rentable_pets[$i]->level;
                            $alias = $rentable_pets[$i]->alias;
                            $puesto = $i + 1;
                            echo "<tr>
                                    <td>
                                        $puesto
                                    </td>
                                    <td>
                                        $alias
                                    </td>
                                    <td>    
                                        $gold_gained
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>


</body>

</html>