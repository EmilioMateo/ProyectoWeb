<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode([]);
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

$stmt = $conn->prepare("SELECT id, titulo, fechaEntrega, materia, completada FROM tareas WHERE id_usuario = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

$tareas = [];

while ($fila = $resultado->fetch_assoc()) {

    $fila['completada'] = $fila['completada'] == 1 ? true : false;
    $tareas[] = $fila;
}


header('Content-Type: application/json');
echo json_encode($tareas);

$stmt->close();
$conn->close();
?>