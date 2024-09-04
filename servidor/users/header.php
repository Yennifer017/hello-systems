<header>
    <h1>Player:
        <?php
        if (isset($_COOKIE["username"])) {
            echo "<b>" . $_COOKIE["username"] . "<b>";
        } else {
            echo "<b>NO ERES BIENVENIDO IMPOSTOR >:( SAL DE AQUI</b>";
        }
        ?>
    </h1>
    <nav>
        <ul>
            <li><a href="../../home.html">Home</a></li>
            <li><a href="../game/dashboard.php">Establo</a></li>
            <li><a href="../store/store.php">Tienda</a></li>
            <li><a href="../plants/garden.php">Jardin</a></li>
            <li><a href="../reports/reports.php">Reportes</a></li>
        </ul>
    </nav>
</header>