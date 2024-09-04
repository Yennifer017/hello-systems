<?php 
function get_player($conn, $id_user, $id_pet){
    //get player
    $sql = "SELECT  Players_animals.id, Players_animals.exp, Players_animals.level, Players_animals.atack, 
            Players_animals.ps, Players_animals.alias, Animals.link_img
            FROM Players_animals
            JOIN Animals ON Players_animals.id_type = Animals.id
            WHERE Players_animals.id_owner = ? AND Players_animals.id = ?
            LIMIT 1 ;
            ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_user, $id_pet);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $player = new Animal($row['id'], $row['exp'], $row['level'], $row['atack'], $row['ps'], 
                $row['link_img'], $row['alias']);
        return $player;
    } else {
        return null;
    }
}

function get_depretator($conn, $difficult){
    //enemigo random
    $sql = "SELECT id, atk_base, ps_base, link_img, def_name FROM Depretator WHERE difficult = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $difficult);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $index = 0;
        $random = rand(0, $result->num_rows -1);
        while (true) {
            $row = $result->fetch_assoc() ;
            if($index == $random){
                $depretator = new Animal($row['id'], 0, 0, $row['atk_base'], $row['ps_base'], 
                        $row['link_img'], $row['def_name']);
                return $depretator;
            } 
            $index = $index + 1;
        }
    }
    return null;
}

function get_players($conn, $id_player){
    $sql = "SELECT  Players_animals.id, Players_animals.exp, 
        Players_animals.level, Players_animals.atack, Players_animals.ps, Players_animals.alias, Animals.link_img
        FROM Players_animals
        JOIN Animals ON Players_animals.id_type = Animals.id
        WHERE Players_animals.id_owner = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_player);
    $stmt->execute();
    $result = $stmt->get_result();
    $animals = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $animals[] = new Animal($row['id'], $row['exp'], $row['level'], 
                $row['atack'], $row['ps'], $row['link_img'], $row['alias']);
        }
    } 
    return $animals;
}
