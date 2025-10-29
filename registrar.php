<?php

$correo = $_POST['correo_electronico'];
$contrasena = $_POST['contrasena'];

$host = 'localhost';
$port = '5432';
$dbname = 'Proyecto_web';
$user = 'postgres';
$password = 'Emiliano+2945';

$conexion_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

$dbconn = pg_connect($conexion_string);

if(!$dbconn){
    echo "Error: no se pudo conectar a la base de datos";
    exit;
}

$Solicitud = "INSERT INTO registro (correo_electronico , contrasena) VALUES ('$correo','$contrasena')";
$resultado = pg_query($dbconn, $Solicitud);

if($resultado){
    echo "Registro Exitoso";
}
else{
    echo "error al registrar: " . pg_last_error($dbconn);
}
pg_close($dbconn);
?>