<?php
$host = 'localhost';
$db = 'portafolio_juegos';
$user = 'root';  // Cambiar si es necesario
$password = '';  // Colocar la contraseña si existe

$conexion = new mysqli($host, $user, $password, $db);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
?>
