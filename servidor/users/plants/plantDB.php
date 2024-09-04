<?php
function get_plants($conn){
    $sql = "SELECT * FROM Plant_potentiator";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $plants = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $plants[] = new Plant($row['id'], $row['cost'], $row['atk'], $row['ps'], 
                    $row['exp'], $row['link_img'], $row['name']);
        }
    }
    return $plants;
}