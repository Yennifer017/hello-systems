<?php 
function get_animals($conn){
    //get player
    $sql = "SELECT * FROM Animals";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $animals = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $animals[] = new Animal_on_sale($row['id'], $row['cost'], $row['atk_base'], 
                        $row['ps_base'], $row['link_img'], $row['def_name']);
        }
    }
    return $animals;
}

function get_animal($conn, $id){
    $sql = "SELECT cost, atk_base, ps_base, def_name FROM Animals WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return new Animal_on_sale($id, $row['cost'], $row['atk_base'], $row['ps_base'], '', $row['def_name']);
    }
    return null;
}
?>