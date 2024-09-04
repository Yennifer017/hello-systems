<?php 

require 'animalDB.php';
require '../../session.php' ; 
require '../../db_connection.php' ; 
require 'animal.php';

$id_pet=$_POST['id_pet']; 
$difficult=$_POST['dificultad']; 
$id_user=get_session_data();
$error = '';

try {

    $depretator = get_depretator($conn, $difficult);
    if($depretator == null){
        $error = "No se han encontrado enemigos";
    }
    $player = get_player($conn, $id_user, $id_pet);
    if($player == null){
        $error = "No se pudo encontrar la mascota para pelear";
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
        <input type="hidden" id="difficult" name="difficult" required value="<?php echo $difficult?>">
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
</script>
<script type="module" src="../../js/game.js"></script> <!-- Esto trata el archivo como módulo -->

</html>