<?php
session_start();
include('conexion.php'); // Conexión a la base de datos

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $juego_id = $_POST['juego_id'];
    $progreso = $_POST['progreso']; // Datos de progreso del juego

    $query = "INSERT INTO progreso (usuario_id, juego_id, progreso) VALUES ('$usuario_id', '$juego_id', '$progreso')
              ON DUPLICATE KEY UPDATE progreso='$progreso'";
    mysqli_query($conexion, $query);
    
    echo "Progreso guardado.";
} else {
    echo "Debes iniciar sesión para guardar tu progreso.";
}
?>
