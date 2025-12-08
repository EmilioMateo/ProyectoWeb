<?php
include "conexion.php";

$id=$_POST['id'];

$stmt = $conn->prepare("DELETE FROM materias WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: TareasPendientes.php")
?>