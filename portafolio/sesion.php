<link rel="stylesheet" href="styles.css">
<?php include('header.php'); ?>
<?php
session_start();
<section>
include('conexion.php'); // Archivo con la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar usuario
    $query = "SELECT * FROM usuarios WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
        // Usuario encontrado, iniciar sesión
        $user = mysqli_fetch_assoc($result);
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];

        header('Location: index.php'); // Redirigir al inicio
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
</section>
?>
<?php include('footer.php'); ?>


