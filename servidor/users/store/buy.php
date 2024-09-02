<?php 
require 'economic.php';
require '../../db_connection.php';

$buy_err = '';

try { 
    //parametros
    $default_value = 0;
    $id_user = get_session_data();
    $current_date = date('Y-m-d H:i:s');
    $id_type = $_POST['id'];
    $alias = $_POST['alias'];

    //obteniendo el animal en venta de la bd
    $sql = "SELECT cost, atk_base, ps_base, def_name FROM Animals WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_type);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if($row['cost'] > $gold){
            $buy_err = "No cuentas con sufiente oro :c";
        } else {
            $conn->begin_transaction();
            //agregarle la mascota
            $add_pet_sql = "INSERT INTO Players_animals(id_owner, date_capture, exp, level, id_type, atack, ps, alias) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_add_pet = $conn->prepare($add_pet_sql);
            $stmt_add_pet->bind_param("isiiiiis", $id_user, $current_date, $default_value, 
                        $default_value, $id_type, $row['atk_base'], $row['ps_base'], $alias);
            $stmt_add_pet->execute();
            $gold = $gold - $row['cost'];
            update_gold($gold, $id_user, $conn);

            $conn->commit();
        }
        
    } else {
        $buy_err = "No se encontro el animal, posiblemente ya no este a la venta";
    }

} catch (Exception $e) {
    $conn->rollback();    
    $buy_err = "" . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/store-styles.css">
</head>

<body>
    <?php 
        include '../header.php'; 
        if($buy_err == ''){
            echo "<h1 class=\"gamer-title\"> Compra exitosa </h1>";
        } else {
            echo "<div class=\"error-message\">" . $buy_err . "</div>
            <img class=\"centrado medium-img\" src=\"https://i.giphy.com/media/v1.Y2lkPTc5MGI3NjExeXNmcTd2NzY2OWZ0aHNzZndsc2Uwd2Qzc2IxN3o3bXBrOXBybGpubCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/3o6UB5RrlQuMfZp82Y/giphy.gif\">";
        }
    ?>
</body>

</html>