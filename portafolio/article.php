<?php include('header.php'); ?>
<?php include('conexion.php'); ?>

<?php
// Obtener el ID del artículo
$articulo_id = $_GET['id'];

// Obtener datos del artículo
$query_articulo = "SELECT * FROM articulos WHERE id = $articulo_id";
$result_articulo = mysqli_query($conexion, $query_articulo); // Cambiamos $conn por $conexion
$articulo = mysqli_fetch_assoc($result_articulo);
?>

<section id="articulo">
    <h2><?php echo $articulo['titulo']; ?></h2>
    <p><?php echo $articulo['contenido']; ?></p>
    <p><small>Publicado el: <?php echo $articulo['fecha']; ?></small></p>
</section>

<!-- Sección de comentarios -->
<section id="comentarios">
    <h3>Comentarios</h3>

    <!-- Mostrar comentarios -->
    <?php
    $query_comentarios = "SELECT c.comentario, c.fecha, u.nombre FROM comentarios c JOIN usuarios u ON c.usuario_id = u.id WHERE articulo_id = $articulo_id ORDER BY c.fecha DESC";
    $result_comentarios = mysqli_query($conexion, $query_comentarios); // Cambiamos $conn por $conexion

    while ($comentario = mysqli_fetch_assoc($result_comentarios)) {
        echo "<div class='comentario'>";
        echo "<p><strong>{$comentario['nombre']}:</strong> {$comentario['comentario']}</p>";
        echo "<p><small>{$comentario['fecha']}</small></p>";
        echo "</div>";
    }
    ?>

    <!-- Formulario para agregar comentario -->
    <?php if (isset($_SESSION['usuario_id'])): ?>
        <form method="POST" action="article.php?id=<?php echo $articulo_id; ?>">
            <textarea name="comentario" placeholder="Escribe un comentario..." required></textarea>
            <button type="submit">Comentar</button>
        </form>
    <?php else: ?>
        <p><a href="login.php">Inicia sesión para comentar</a></p>
    <?php endif; ?>
</section>

<?php
// Insertar comentario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $comentario = $_POST['comentario'];

    $query_insert_comentario = "INSERT INTO comentarios (articulo_id, usuario_id, comentario) VALUES ($articulo_id, $usuario_id, '$comentario')";
    mysqli_query($conexion, $query_insert_comentario); // Cambiamos $conn por $conexion

    header("Location: article.php?id=$articulo_id");
}
?>

<?php include('footer.php'); ?>

