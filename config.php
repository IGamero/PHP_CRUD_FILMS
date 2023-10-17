<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$servername = $_SERVER['DB_HOST'];
$username = $_SERVER['DB_USER'];
$password = $_SERVER['DB_PASSWORD'];
$database = $_SERVER['DB_DATABASE'];


$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
} else {
    echo "Conectado";
}
?>