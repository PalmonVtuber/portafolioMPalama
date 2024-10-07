<?php include('header.php'); ?>
<?php
// Conexión a la base de datos
include('conexion.php');

// Consulta para obtener los puntajes de los usuarios
$query = "SELECT usuarios.nombre, progreso.puntaje 
          FROM usuarios 
          JOIN progreso 
          ON usuarios.id = progreso.usuario_id 
          ORDER BY progreso.puntaje DESC LIMIT 10";

// Ejecutar la consulta
$result = mysqli_query($conexion, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Mostrar el ranking de jugadores
echo "<h2>Ranking de Jugadores</h2>";
echo "<table>";
echo "<thead>
        <tr>
            <th>Jugador</th>
            <th>Puntaje</th>
        </tr>
      </thead>";
echo "<tbody>";

// Si hay resultados, se muestran en una tabla
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['nombre']}</td>
                <td>{$row['puntaje']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='2'>No hay puntajes disponibles.</td></tr>";
}

echo "</tbody>";
echo "</table>";

// Enlace para volver a jugar
echo "<a href='snake.html'>Volver a jugar</a>";
?>
<?php
include('conexion.php');

// ID del juego para el ranking de "Flappy Bird"
$juego_id = 1; 

$query = "SELECT usuarios.nombre, progreso.puntaje 
          FROM usuarios 
          JOIN progreso ON usuarios.id = progreso.usuario_id 
          WHERE progreso.juego_id = '$juego_id' 
          ORDER BY progreso.puntaje DESC 
          LIMIT 10";
$result = mysqli_query($conexion, $query);

echo "<h2>Ranking de Jugadores de Flappy Bird</h2>";
echo "<ul>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>{$row['nombre']} - {$row['puntaje']} puntos</li>";
}
echo "</ul>";

?>

<?php include('footer.php'); ?>

