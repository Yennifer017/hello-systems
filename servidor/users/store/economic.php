<?php
require '../../session.php';
require '../../db_connection.php';

function get_gold($conn, $id_user){
    $gold = 0;

    $sql = "SELECT gold FROM Users WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gold = $row["gold"];
        return $gold;
    } else {
        return -1;
    }
}

function plus_gold($value, $id_user, $conn){
    $sql_update = "UPDATE Users SET gold = gold + ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ii", $value, $id_user);
    $stmt_update->execute();
}

function less_gold($value, $id_user, $conn){
    $sql_update = "UPDATE Users SET gold = gold - ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ii", $value, $id_user);
    $stmt_update->execute();
}


?>