<?php
include "conexion.php";

$materia=$_POST['nombre'];


$stmt = $conn->prepare("INSERT INTO materias(nombre) VALUES (?)");
$stmt->bind_param("s", $materia);
$stmt->execute();

header("Location: TareasPendientes.php")
?>