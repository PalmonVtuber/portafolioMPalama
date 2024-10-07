<?php
$juego_id = $_GET['juego_id'];
$query = "SELECT * FROM notas WHERE juego_id='$juego_id'";
$result = mysqli_query($conexion, $query);

while ($nota = mysqli_fetch_assoc($result)) {
    echo "<p>{$nota['nota']}</p>";
}
?>
