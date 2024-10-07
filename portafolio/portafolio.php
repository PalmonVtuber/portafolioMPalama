<?php
include('header.php'); 
include('conexion.php'); // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enlace'])) {
    $enlaceOriginal = $_POST['enlace'];

    // Verificar si el enlace está en el formato correcto
    if (filter_var($enlaceOriginal, FILTER_VALIDATE_URL)) {
        // Insertar el enlace en la base de datos
        $sql = "INSERT INTO enlaces (enlace_original) VALUES ('$enlaceOriginal')";
        if (mysqli_query($conn, $sql)) {
            $id = mysqli_insert_id($conn); // Obtener el ID insertado
            $codigoAcortado = base_convert($id, 10, 36); // Convertir a base 36 para acortar

            // Actualizar la base de datos con el código acortado
            $sqlUpdate = "UPDATE enlaces SET enlace_acortado = '$codigoAcortado' WHERE id = $id";
            mysqli_query($conn, $sqlUpdate);

            // Mostrar el enlace acortado al usuario
            echo "<p>Enlace acortado: <a href='redirect.php?codigo=$codigoAcortado'>http://tu-dominio.com/$codigoAcortado</a></p>";
        } else {
            echo "<p>Error al acortar el enlace. Por favor, inténtalo de nuevo.</p>";
        }
    } else {
        echo "<p>Por favor, ingresa un enlace válido.</p>";
    }
}
?>

<section id="proyectos">
    <h2>Proyectos</h2>

    <!-- Sección del acortador de enlaces -->
    <div class="acortador-enlaces">
        <h3>Acortador de Enlaces</h3>
        <form method="POST" action="proyectos.php">
            <label for="enlace">Introduce un enlace:</label>
            <input type="url" id="enlace" name="enlace" required>
            <button type="submit">Acortar Enlace</button>
        </form>
    </div>

    <!-- Sección de proyectos -->
    <div class="proyecto">
        <h3>Proyecto 1</h3>
        <p>Descripción breve del proyecto.</p>
    </div>
    <div class="proyecto">
        <h3>Proyecto 2</h3>
        <p>Descripción breve del proyecto.</p>
    </div>
</section>

<?php include('footer.php'); ?>

