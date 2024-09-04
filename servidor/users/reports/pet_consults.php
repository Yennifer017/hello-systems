<?php 
require '../game/animal.php';

function get_most_rentable_pets($conn, $id_user){
    $sql = "SELECT Players_animals.alias, SUM(Statistics.gold_gained) AS total_gold
            FROM Statistics
            JOIN Players_animals ON Statistics.id_player = Players_animals.id
            WHERE id_user = ?
            GROUP BY id_player
            ORDER BY total_gold DESC
            LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $pets = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pets[] = new Animal(0, 0, $row['total_gold'], 0, 0, '', $row['alias']);
        }
    }
    return $pets;
}

function get_most_gained_pets($conn, $id_user){
    $sql = "SELECT Players_animals.alias, SUM(Statistics.points) AS total_points
        FROM Statistics
        JOIN Players_animals ON Statistics.id_player = Players_animals.id
        WHERE id_user = ?
        GROUP BY id_player
        ORDER BY total_points DESC
        LIMIT 5;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $pets = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pets[] = new Animal(0, 0, $row['total_points'], 0, 0, '', $row['alias']);
        }
    }
    return $pets;
}

function get_most_level_pets($conn, $id_user){
    $sql = "SELECT alias, level, exp
            FROM Players_animals
            WHERE id_owner = ?
            ORDER BY level DESC, exp DESC
            LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $pets = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pets[] = new Animal(0, $row['exp'], $row['level'], 0, 0, '', $row['alias']);
        }
    }
    return $pets;
}

function get_most_used_pets($conn, $id_user){
    $sql = "SELECT Players_animals.alias, COUNT(*) AS total_uses
            FROM Statistics
            JOIN Players_animals ON Statistics.id_player = Players_animals.id
            WHERE id_user = ?   
            GROUP BY id_player
            ORDER BY total_uses DESC
            LIMIT 5;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $pets = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pets[] = new Animal(0, 0, $row['total_uses'], 0, 0, '', $row['alias']);
        }
    }
    return $pets;
}

?>