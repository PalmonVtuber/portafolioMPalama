<link rel="stylesheet" href="styles.css">
<?php
include('conexion.php'); // Asegúrate de tener el archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Puedes aplicar aquí hash para la contraseña si es necesario: password_hash($password, PASSWORD_DEFAULT)
    
    $query = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
    
    if (mysqli_query($conexion, $query)) {
        echo "Usuario registrado con éxito.";
        header('Location: iniciar_sesion.php'); // Redirigir al login
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>
