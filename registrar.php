<?php

include 'conexion.php';

if (!isset($_POST['correo_electronico']) || !isset($_POST['contrasena'])) {
    die("Error: No se recibieron datos. Debes usar el formulario de registro.");
}

$nombre_usuario = $_POST['correo_electronico']; 
$contrasena = $_POST['contrasena'];

$check = $conn->prepare("SELECT id FROM usuarios WHERE nombre = ?");
$check->bind_param("s", $nombre_usuario);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "Error: El usuario ya existe.";
} else {

    $pass_hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, contrasena) VALUES (?, ?)");
    $stmt->bind_param("ss", $nombre_usuario, $pass_hash);

    if ($stmt->execute()) {
        echo "Registro Exitoso";
    } else {
        echo "Error al registrar: " . $conn->error;
    }
    $stmt->close();
}

$check->close();
$conn->close();
?>
