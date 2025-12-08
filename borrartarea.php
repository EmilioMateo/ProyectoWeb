<?php
include "conexion.php";


$idtarea=$_POST['id_tarea2'];


$stmt = $conn->prepare("DELETE FROM  tareas WHERE id=?");
$stmt->bind_param("i",   $idtarea);
$stmt->execute();

header("Location: TareasPendientes.php")
?>