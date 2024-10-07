
<?php
include('conexion.php');
session_start();

// Verifica que el usuario haya iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    die("Debes iniciar sesión para guardar tu puntaje.");
}

$usuario_id = $_SESSION['usuario_id'];  // ID del usuario actual
$juego_id = 1; // ID del juego "Flappy Bird", asegúrate de tener este ID correcto
$puntaje = $_POST['puntaje'];
$progreso = "Juego completado"; // Esto es un ejemplo, puedes cambiar el texto según lo que necesites

// Verifica si ya existe un registro para este usuario y juego
$query_verificar = "SELECT * FROM progreso WHERE usuario_id = '$usuario_id' AND juego_id = '$juego_id'";
$result_verificar = mysqli_query($conexion, $query_verificar);

if (mysqli_num_rows($result_verificar) > 0) {
    // Si ya existe un registro, actualizamos el puntaje y el progreso
    $query_actualizar = "UPDATE progreso SET puntaje = '$puntaje', progreso = '$progreso' WHERE usuario_id = '$usuario_id' AND juego_id = '$juego_id'";
    $result_actualizar = mysqli_query($conexion, $query_actualizar);
    
    if ($result_actualizar) {
        echo "Puntaje actualizado exitosamente";
    } else {
        echo "Error al actualizar el puntaje";
    }
} else {
    // Si no existe un registro, lo insertamos
    $query_insertar = "INSERT INTO progreso (usuario_id, juego_id, progreso, puntaje) VALUES ('$usuario_id', '$juego_id', '$progreso', '$puntaje')";
    $result_insertar = mysqli_query($conexion, $query_insertar);

    if ($result_insertar) {
        echo "Puntaje guardado exitosamente";
    } else {
        echo "Error al guardar el puntaje";
    }
}
?>


