<?php 
require '../../db_connection.php' ; 
require 'animal.php';
require 'animalDB.php';
require '../store/economic.php';
require 'reward.php';

$error = '';

$id_user = get_session_data();
$state = $_POST['state'];
$date = $current_date = date('Y-m-d H:i:s');
$points = 0;
$gold_gained = 0;
$id_pet =  $_POST['idPlayer'];
$id_depretator = $_POST['idDepretator'];
$difficult = $_POST['difficult'];

$pet = get_player($conn, $id_user, $id_pet);

$sql = "INSERT INTO Statistics(id_user, state, date, points, gold_gained, id_player, id_depretator) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
try {
    $conn->begin_transaction();
    if($state == 'WINNER'){
        //sumar oro
        $extra_gold = get_gold_reward($difficult);
        $gold_gained = $extra_gold;
        plus_gold($extra_gold, $id_user, $conn);
        //actualizar experiencia
        $exp_gained = get_exp_reward($difficult, $pet->level);
        $points = $exp_gained;
        $pet->update_exp($conn, $id_user, $exp_gained);
    }
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issiiii", $id_user, $state, $date, $points, $gold_gained, $pet->id, $id_depretator);
    $stmt->execute();

    $conn->commit();

    header("Location: ./dashboard.php");
    exit();
} catch (Exception $e) {
    $conn->rollback();
    $error = "" . $e->getMessage(); 
}

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
    <div class="error-message">
        <h2>Error</h2>
        <p><?php echo $error ?></p>
    </div>

</body>


</html>