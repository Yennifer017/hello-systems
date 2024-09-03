<?php 

require '../../session.php' ; 
require '../../db_connection.php' ; 
require 'owned-animal.php';

$id_pet=$_POST['id_pet']; 
$difficult=$_POST['dificultad']; 
$id_user=get_session_data();
$error = '';

try {
    //enemigo random
    $sql_depretator = "SELECT id, atk_base, ps_base, link_img, def_name FROM Depretator WHERE difficult = ?";
    $stmt_depretator = $conn->prepare($sql_depretator);
    $stmt_depretator->bind_param("s", $difficult);
    $stmt_depretator->execute();
    $result_depretators = $stmt_depretator->get_result();

    if ($result_depretators->num_rows > 0) {
        $index = 0;
        $random = rand(0, $result_depretators->num_rows -1);
        while (true) {
            $row = $result_depretators->fetch_assoc() ;
            if($index == $random){
                $depretator = new Owned_animal($row['id'], 0, 0, $row['atk_base'], $row['ps_base'], 
                        $row['link_img'], $row['def_name']);
                break;
            } 
            $index = $index + 1;
        }
    } else {
        $error = "No se han encontrado enemigos :c\n";
    }

    //get player
    $sql_player = "SELECT  Players_animals.id, Players_animals.exp, Players_animals.level, Players_animals.atack, 
            Players_animals.ps, Players_animals.alias, Animals.link_img
            FROM Players_animals
            JOIN Animals ON Players_animals.id_type = Animals.id
            WHERE Players_animals.id_owner = ? AND Players_animals.id = ?
            LIMIT 1 ;
            ";
    $stmt_player = $conn->prepare($sql_player);
    $stmt_player->bind_param("ii", $id_user, $id_pet);
    $stmt_player->execute();
    $result_player = $stmt_player->get_result();

    if ($result_player->num_rows > 0) {
        $row = $result_player->fetch_assoc();
        $player = new Owned_animal($row['id'], $row['exp'], $row['level'], $row['atack'], $row['ps'], 
                $row['link_img'], $row['alias']);
    } else {
        $error = "No se pudo encontrar la mascota para pelear\n";
    }

} catch (mysqli_sql_exception $e) {
    $error = "" . $e->getMessage();
}

//convertir los jugadores a json
$depretator_json = json_encode($depretator);
$player_json = json_encode($player);
    
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/game-styles.css">
</head>

<body>

    <h1 class="gamer-title">BATALLA!!!</h1>

    <div class="game centrado">
        <div class="animal right">
            <img src="<?php echo '../' . $player->link?>" alt="Animal 1">
            <p>Nombre: 
                <?php echo $player->alias?>
            </p>
            <p>Ataque: 
                <?php echo $player->atk?>
            </p>
            <p>Puntos de salud: 
                <span id="psPlayer">
                    <?php echo $player->ps?>
                </span>
            </p>
            <p>Nivel:
                <?php echo $player->level?>
            </p>
            <p>Experiencia:
                <?php echo $player->exp?>
            </p>
            <div>
                <button id="attackBtn">Atacar</button>
                <button id="defendBtn">Defender</button>
                <button id="escBtn">Huir</button>
            </div>
        </div>
        <div class="animal left">
            <img src="<?php echo '../' . $depretator->link?>" alt="Animal 2">
            <p>Nombre: 
                <?php echo $depretator->alias?>
            </p>
            <p>Ataque: 
                <?php echo $depretator->atk?>
            </p>
            <p>Puntos de salud: 
                <span id="psDepretator">
                    <?php echo $depretator->ps?>
                </span>
            </p>
        </div>
    </div>
    <div class="actions centrado">
        <p>Último movimiento del usuario:
            <span id="playerLastMove">???</span>
        </p>
        <p>Último movimiento del contrincante:
            <span id="depretatorLastMove">???</span>
        </p>
    </div>

    <div class="internal centrado">
        <?php
        if ($error != "") {
            echo "<div class=\"error-message\">" . $error . "</div>";
        }
        ?>
    </div>
    
    <form action="process.php" method="POST">
        <input type="hidden" id="state" name="state" required value="INCOMPLEATE">
        <input type="hidden" id="idPlayer" name="idPlayer" required value="<?php echo $player->id?>">
        <input type="hidden" id="idDepretator" name="idDepretator" required value="<?php echo $depretator->id?>">
        <button type="submit" style="display: none;" id="submitStatisticBtn"></button>
    </form>

</body>

<script>
// Pasar los objetos a JavaScript
const depretatorData = <?php echo $depretator_json; ?>;
const playerData = <?php echo $player_json; ?>;
const difficult = <?php echo json_encode($difficult);?>;
</script>
<script type="module" src="../../js/game.js"></script> <!-- Esto trata el archivo como módulo -->

</html>