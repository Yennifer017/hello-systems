<?php
$socket = '/run/mysqld/mysqld.sock'; // Ruta al archivo del socket

$servername = "localhost";
$username = "teo";
$password = "i-am-root";
$dbname = "hellosystems";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname, null, $socket);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// configurar el conjunto de caracteres
$conn->set_charset("utf8");

?>
