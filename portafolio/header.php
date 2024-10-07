<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Portafolio</title>
    <link rel="stylesheet" href="styles.css"> <!-- Vincula tu archivo CSS -->
</head>
<script type="text/javascript">
  (function(d, t) {
      var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
      v.onload = function() {
        window.voiceflow.chat.load({
          verify: { projectID: '66fe9cda37c4e356c1ccfda4' },
          url: 'https://general-runtime.voiceflow.com',
          versionID: 'production'
        });
      }
      v.src = "https://cdn.voiceflow.com/widget/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
  })(document, 'script');
</script>
<body>

<header>
    <div class="video-background">
        <video autoplay muted loop id="video-fondo">
            <source src="imagenes/fondovideo.mp4" type="video/mp4">
            Tu navegador no soporta la etiqueta de video.
        </video>
    </div>
    <div class="logo">
        <img id="logoimg" src="imagenes/logo.png" alt="Logo"> <!-- Asegúrate de que el 'id' sea 'logo-img' -->
    </div>
        <nav>
        <?php
            session_start(); // Asegurarse de iniciar la sesión al inicio del archivo PHP
        ?>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="sobre_mi.php">Sobre Mí</a></li>
            <li><a href="proyectos.php">Portafolio</a></li>
            <li><a href="blog.php">Blog</a></li>

            <?php if (isset($_SESSION['usuario_id'])): ?> <!-- Si el usuario está logueado -->
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            <?php else: ?> <!-- Si el usuario no ha iniciado sesión -->
                <li><a href="registrarse.php">Registrarse</a></li>
                <li><a href="iniciar_sesion.php">Iniciar Sesión</a></li>
            <?php endif; ?>
        </ul>

    </nav>
</header>

<!
<!-- JavaScript para cambiar el logo -->
<script>
    // Lista de imágenes
    const logos = [
        'imagenes/logo.png',
        'imagenes/logo1.png',
        'imagenes/logo2.png',
        'imagenes/logo3.png'
        'imagenes/logo4.png'
    ];

    // Selecciona la imagen del logo
    const logoImg = document.getElementById('logo-img');

    // Contador para llevar el control del índice de la imagen
    let currentIndex = 0;

    // Función para cambiar el logo
    function changeLogo() {
        // Incrementa el índice
        currentIndex = (currentIndex + 1) % logos.length;

        // Cambia la imagen del logo
        logoImg.src = logos[currentIndex];
    }

    // Cambia el logo cada 5 segundos (5000 ms)
    setInterval(changeLogo, 5000);
</script>

</body>
</html>





