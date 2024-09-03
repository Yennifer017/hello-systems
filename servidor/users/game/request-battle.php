<?php

$id_pet = $_POST['id'];
$alias_pet = $_POST['alias'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../styles/styles.css">
</head>

<body>
    <?php include '../header.php'; ?>
    <h1 class="gamer-title">MANDAR A BATALLA...</h1>

    <div class="gamer-form div-centrado">
        <h2>Datos</h2>
        <form action="game.php" method="POST">

            <input type="hidden" id="id_pet" name="id_pet" required value=" <?php echo $id_pet; ?> ">
            <p>Nombre de la mascota: <?php echo $alias_pet; ?></p>

            <hr>
            <label for="dificultad">Selecciona la dificultad:</label>
            <select id="dificultad" name="dificultad">
                <option value="EASY">Fácil (contra un carnivoro)</option>
                <option value="MEDIUM">Media (contra descomponedores)</option>
                <option value="HARD">Difícil (contra bacterias)</option>
            </select>
            <button type="submit">Jugar</button>

        </form>

    </div>

</body>

</html>