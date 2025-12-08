<?php
include "conexion.php";

$id=$_POST['id'];
$nombre=$_POST['nombre'];
$stmt = $conn->prepare("UPDATE  materias SET nombre=?  WHERE id=?");
$stmt->bind_param("si", $nombre,$id);
$stmt->execute();

header("Location: TareasPendientes.php")
?>