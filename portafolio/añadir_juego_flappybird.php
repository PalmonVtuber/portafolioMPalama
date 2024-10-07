<?php
// añadir_juego_flappybird.php

include('conexion.php');

// Consulta SQL para insertar el juego "Flappy Bird"
$sql = "INSERT INTO juegos (nombre, descripcion, url) 
        VALUES ('Flappy Bird', 'Juego clásico de Flappy Bird donde controlas un pájaro que debe evitar los tubos.', 'juegos/flappybird.html')";

if (mysqli_query($conexion, $sql)) {
    echo "El juego 'Flappy Bird' ha sido añadido exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
