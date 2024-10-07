
<?php include('header.php'); ?>
<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

// Aquí puedes hacer una consulta a la base de datos para obtener información del usuario
// y su progreso en los juegos

echo "<h1>Bienvenido a tu perfil, " . $_SESSION['usuario_nombre'] . "</h1>";
// Mostrar otra información del usuario, como el progreso en los juegos
?>
<li><a href="juegos.php">Ir a jugar </a></li>
<?php include('footer.php'); ?>
