<?php
include('conexion.php');

$codigoAcortado = $_GET['codigo'];

// Buscar el enlace original en la base de datos
$sql = "SELECT enlace_original FROM enlaces WHERE enlace_acortado = '$codigoAcortado' LIMIT 1";
$resultado = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado);

if ($row) {
    // Redireccionar al enlace original
    header("Location: " . $row['enlace_original']);
    exit();
} else {
    echo "Enlace no encontrado.";
}
?>
