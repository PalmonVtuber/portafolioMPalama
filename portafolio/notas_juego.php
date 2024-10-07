<?php
session_start();
include('conexion.php');

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $juego_id = $_POST['juego_id'];
    $nota = $_POST['nota'];

    $query = "INSERT INTO notas (usuario_id, juego_id, nota) VALUES ('$usuario_id', '$juego_id', '$nota')";
    mysqli_query($conexion, $query);
    
    echo "Nota guardada.";
} else {
    echo "Debes iniciar sesión para dejar una nota.";
}
?>
