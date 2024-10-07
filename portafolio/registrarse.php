<link rel="stylesheet" href="styles.css">
<?php include('header.php'); ?>

<section id="registrarse">
    <h2>Crea tu cuenta</h2>
    <form action="registrar_usuario.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        
        <input type="submit" value="Registrarse">
    </form>
</section>

<?php include('footer.php'); ?>
