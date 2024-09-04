<?php 

require '../../db_connection.php';
require '../../session.php';
require 'depr_consults.php';

$id_user = get_session_data();
$dangerous_deprs = get_most_letal_dep($conn, $id_user);
$viewed_deprs = get_most_view_dep($conn, $id_user);
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
                <h3 class="gamer-title small-title">Top 5 depredadores mas letales</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>Nombre</th>
                            <th>Total de combates perdidos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                        for ($i = 0; $i < count($dangerous_deprs); $i++) {
                            $dead_times= $dangerous_deprs[$i]->level;
                            $name = $dangerous_deprs[$i]->alias;
                            $puesto = $i + 1;
                            echo "<tr>
                                    <td>
                                        $puesto
                                    </td>
                                    <td>
                                        $name
                                    </td>
                                    <td>    
                                        $dead_times
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <hr class="divisor">
            <div>
                <h3 class="gamer-title small-title">Top 5 depredadores mas encontrados</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>Alias</th>
                            <th>Veces encontrado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                        for ($i = 0; $i < count($viewed_deprs); $i++) {
                            $times = $viewed_deprs[$i]->level;
                            $name = $viewed_deprs[$i]->alias;
                            $puesto = $i + 1;
                            echo "<tr>
                                    <td>
                                        $puesto
                                    </td>
                                    <td>
                                        $name
                                    </td>
                                    <td>    
                                        $times
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