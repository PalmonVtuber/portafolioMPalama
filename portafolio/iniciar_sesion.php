<link rel="stylesheet" href="styles.css">
<?php 
// Incluir el archivo del header y iniciar sesión
include('header.php'); 
session_start();

// Incluir la conexión a la base de datos
include('conexion.php');

// Verificar si el formulario fue enviado por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el email y la contraseña del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparar la consulta para evitar inyección SQL
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param('s', $email); // 's' indica que el parámetro es una cadena (string)
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows > 0) {
        // Usuario encontrado, obtener los datos
        $user = $result->fetch_assoc();
        
        // Verificar la contraseña
        // Usar una comparación simple si las contraseñas no están hasheadas
        // Cambia esto a password_verify si las contraseñas están hasheadas
        if ($password === $user['password']) {
            // Guardar datos de sesión
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['nombre'];

            // Redirigir al usuario a la página de juegos
            header('Location: juegos.php');
            exit();
        } else {
            // Contraseña incorrecta
            echo "<p style='color: red; text-align: center;'>Contraseña incorrecta.</p>";
        }
    } else {
        // No se encontró un usuario con ese correo
        echo "<p style='color: red; text-align: center;'>No se encontró una cuenta con ese correo.</p>";
    }
}
?>

<!-- Formulario de inicio de sesión -->
<section id="iniciar_sesion">
    <h2>Iniciar Sesión</h2>
    <form action="iniciar_sesion.php" method="post">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Iniciar Sesión">
    </form>
</section>

<?php include('footer.php'); ?> 


