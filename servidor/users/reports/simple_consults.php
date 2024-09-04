<?php 
require '../game/animal.php';
function get_simple_statistics($conn, $id_user){
    $sql = "SELECT state, COUNT(*) AS count FROM Statistics WHERE id_user = ? GROUP BY state";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $states = [];
        while ($row = $result->fetch_assoc()) {
            $states[] = $row['state'] . " : " . $row['count'];
        }
        return $states;
    } else {
        return null;
    }
}

function get_total_gold($conn, $id_user, $init, $end){
    $sql = "SELECT SUM(gold_gained) AS total FROM Statistics WHERE id_user = ? AND date BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_user, $init, $end);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return -1;
    }
}