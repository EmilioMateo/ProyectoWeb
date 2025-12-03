<?php
$host = "localhost";
$usuario = "root";      
$password = "";         
$base_datos = "Proyecto_Web";


$conn = new mysqli($host, $usuario, $password, $base_datos);


if ($conn->connect_error) {
    die("Fallo la conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>