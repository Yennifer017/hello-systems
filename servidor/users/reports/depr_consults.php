<?php 

require '../game/animal.php';

function get_most_letal_dep($conn, $id_user){
    $sql = "SELECT Depretator.def_name, COUNT(*) AS count
            FROM Statistics
            JOIN Depretator ON Statistics.id_depretator = Depretator.id
            WHERE id_user = ? AND Statistics.state = 'LOSER'
            GROUP BY Statistics.id_depretator
            ORDER BY count DESC
            LIMIT 5
            ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $pets = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pets[] = new Animal(0, 0, $row['count'], 0, 0, '', $row['def_name']);
        }
    }
    return $pets;
}

function get_most_view_dep($conn, $id_user){
    $sql = "SELECT Depretator.def_name, COUNT(*) AS count
            FROM Statistics
            JOIN Depretator ON Statistics.id_depretator = Depretator.id
            WHERE id_user = ?
            GROUP BY Statistics.id_depretator
            ORDER BY count DESC
            LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $pets = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pets[] = new Animal(0, 0, $row['count'], 0, 0, '', $row['def_name']);
        }
    }
    return $pets;
}
