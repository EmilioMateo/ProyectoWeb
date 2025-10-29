<?php

$correo = $_POST['correo_electronico'];
$contrasena_usuario = $_POST['contrasena']; 


$host = 'localhost';
$port = '5432';
$dbname = 'Proyecto_web'; 
$user = 'postgres';
$password = 'Emiliano+2945'; 

$conexion_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$dbconn = pg_connect($conexion_string);

if (!$dbconn) {
    echo "Error: no se pudo conectar a la base de datos";
    exit;
}


$Solicitud = "SELECT contrasena FROM registro WHERE correo_electronico = '$correo'";
$resultado = pg_query($dbconn, $Solicitud);

if ($resultado) {

    if (pg_num_rows($resultado) == 1) {

        $fila = pg_fetch_assoc($resultado);
        $contrasena_bd = $fila['contrasena'];


        if ($contrasena_usuario == $contrasena_bd) {
            echo "Bienvenido de vuelta, $correo!";
        } else {
            echo "Error: Correo o contraseña incorrectos.";
        }

    } else {

        echo "Error: Correo o contraseña incorrectos.";
    }
} else {
    echo "Error en la consulta: " . pg_last_error($dbconn);
}

pg_close($dbconn);
?>