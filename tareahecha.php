<?php
include "conexion.php";


$idtarea=$_POST['id_tarea'];


$stmt = $conn->prepare("UPDATE  tareas SET completada=1 WHERE id=?");
$stmt->bind_param("i",   $idtarea);
$stmt->execute();

header("Location: TareasPendientes.php")
?>