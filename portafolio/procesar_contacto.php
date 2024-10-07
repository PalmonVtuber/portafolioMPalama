<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Aquí puedes enviar el mensaje por correo, guardar en una base de datos, etc.
    // Por ahora, simplemente redirige a una página de agradecimiento
    header("Location: gracias.php");
    exit();
}
?>
