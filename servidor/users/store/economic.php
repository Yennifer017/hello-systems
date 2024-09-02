<?php
require '../../session.php';
require '../../db_connection.php';
$error = '';
$gold = 0;
try { //get gold
    $id_user = get_session_data();

    $sql = "SELECT gold FROM Users WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gold = $row["gold"];
    } else {
        $error = 'No se ha iniciado session';
    }
} catch (mysqli_sql_exception $e) {
    $error = "" . $e->getMessage();
}

function update_gold($value, $id_user, $conn){
    $sql_update = "UPDATE Users SET gold = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ii", $value, $id_user);
    $stmt_update->execute();
}

?>