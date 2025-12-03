<?php

include 'conexion.php'; 


session_start();

if (!isset($_POST['correo_electronico']) || !isset($_POST['contrasena'])) {

    exit;
}

$nombre_usuario = $_POST['correo_electronico'];
$contrasena_input = $_POST['contrasena'];


$stmt = $conn->prepare("SELECT id, nombre, contrasena FROM usuarios WHERE nombre = ?");
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {

    if (password_verify($contrasena_input, $fila['contrasena'])) {
        
  
        $_SESSION['id_usuario'] = $fila['id'];
        $_SESSION['nombre_usuario'] = $fila['nombre'];

        echo "Bienvenido " . $fila['nombre']; 
    } else {
        echo "Error: Contraseña incorrecta.";
    }
} else {
    echo "Error: Usuario no encontrado.";
}

$stmt->close();
$conn->close();
?>