<?php
session_start();
include('conexion.php');

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $juego_id = $_GET['juego_id'];

    // Registrar o actualizar la conexión
    $query = "
        INSERT INTO conexiones (usuario_id, juego_id) 
        VALUES ('$usuario_id', '$juego_id')
        ON DUPLICATE KEY UPDATE ultima_conexion = CURRENT_TIMESTAMP
    ";
    mysqli_query($conexion, $query);

    // Obtener la URL del juego para redirigir
    $query_juego = "SELECT url FROM juegos WHERE id = '$juego_id'";
    $result = mysqli_query($conexion, $query_juego);
    $juego = mysqli_fetch_assoc($result);

    // Redirigir al juego
    header("Location: {$juego['url']}");
    exit();
} else {
    echo "Debes iniciar sesión para jugar.";
}
?>

