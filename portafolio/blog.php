<?php include('header.php'); ?>
<?php include('conexion.php'); ?>

<section id="blog">
    <h2>Blog</h2>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="blog.php">
        <input type="text" name="search" placeholder="Buscar artículos...">
        <button type="submit">Buscar</button>
    </form>

    <?php
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $query = "SELECT * FROM articulos WHERE titulo LIKE '%$search%' ORDER BY fecha DESC";
    $result = mysqli_query($conexion, $query);

    while ($articulo = mysqli_fetch_assoc($result)) {
        echo "<div class='articulo'>";
        echo "<h3><a href='article.php?id={$articulo['id']}'>{$articulo['titulo']}</a></h3>";
        echo "<p>" . substr($articulo['contenido'], 0, 100) . "...</p>";
        echo "<p><small>Publicado el: {$articulo['fecha']}</small></p>";
        echo "</div>";
    }
    ?>
</section>

<?php include('footer.php'); ?>

