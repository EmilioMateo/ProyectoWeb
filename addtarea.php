<?php
include "conexion.php";
session_start();

$iduser=$_SESSION['id_usuario'];
$titulo=$_POST['titulo'];
$materia=$_POST['materia'];
$fecha=$_POST['fecha'];

$stmt = $conn->prepare("INSERT INTO tareas(id_usuario, titulo, fechaEntrega, materia, completada) VALUES (?,?,?,?,0)");
$stmt->bind_param("issi", $iduser, $titulo, $fecha, $materia);
$stmt->execute();

header("Location: TareasPendientes.php")
?>