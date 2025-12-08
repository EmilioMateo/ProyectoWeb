<?php
include "conexion.php";


$idtarea=$_POST['id_tarea'];
$titulo=$_POST['titulo'];
$materia=$_POST['materia'];
$fecha=$_POST['fecha'];

$stmt = $conn->prepare("UPDATE  tareas SET titulo=?, fechaEntrega=?, materia=? WHERE id=?");
$stmt->bind_param("sssi",  $titulo, $fecha, $materia, $idtarea);
$stmt->execute();

header("Location: TareasPendientes.php")
?>