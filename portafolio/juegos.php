<?php include('header.php'); ?>
<form method="GET" action="juegos.php">
    <input type="text" name="busqueda" placeholder="Buscar juego..." />
    <button type="submit">Buscar</button>
</form>
<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    // Si el usuario no está autenticado, lo rediriges al login
    header("Location: iniciar_sesion.php");
    exit();
}
?>

<?php
session_start(); // Mantiene la sesión activa

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juegos Disponibles</title>
</head>
<body>
    
    <div class="games-container">
    <h2>Juegos Disponibles</h2>
    <div class="game">
        <a class="game-link" href="snake.html">Jugar Snake</a>
    </div>
    <div class="game">
        <a class="game-link" href="flappybird.html">Jugar Flappy Bird</a>
    </div>
    <a class="game-link" href="logout.php">Cerrar Sesión</a>
</div>
</body>
</html>


<section id="juegos">
    <h2>Juegos Disponibles</h2>
    <div class="juegos-container">
        <?php
        session_start(); // O en header.php, pero solo una vez
        include('conexion.php');

        if (!$conexion) {
            die("Error al conectar con la base de datos: " . mysqli_connect_error());
        }

        if (isset($_SESSION['usuario_id'])) {
            $usuario_id = $_SESSION['usuario_id'];

            // Agregar búsqueda
            if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
                $busqueda = mysqli_real_escape_string($conexion, $_GET['busqueda']);
                $query = "
                    SELECT juegos.id, juegos.nombre, juegos.descripcion, juegos.url
                    FROM juegos
                    LEFT JOIN conexiones ON juegos.id = conexiones.juego_id AND conexiones.usuario_id = '$usuario_id'
                    WHERE juegos.nombre LIKE '%$busqueda%'
                    ORDER BY conexiones.ultima_conexion DESC, juegos.fecha_agregado DESC
                ";
            } else {
                // Consulta original si no hay búsqueda
                $query = "
                    SELECT juegos.id, juegos.nombre, juegos.descripcion, juegos.url
                    FROM juegos
                    LEFT JOIN conexiones ON juegos.id = conexiones.juego_id AND conexiones.usuario_id = '$usuario_id'
                    ORDER BY conexiones.ultima_conexion DESC, juegos.fecha_agregado DESC
                ";
            }

            $result = mysqli_query($conexion, $query);

            while ($juego = mysqli_fetch_assoc($result)) {
                echo "<div class='juego'>";
                echo "<h3>{$juego['nombre']}</h3>";
                echo "<iframe src='{$juego['url']}' width='600' height='400'></iframe>";
                echo "<p>{$juego['descripcion']}</p>";
                echo "<a href='jugar.php?juego_id={$juego['id']}'>Jugar</a>";

                // Consulta y muestra el ranking de los mejores jugadores para este juego
                $query_ranking = "
                    SELECT usuarios.nombre, rankings.puntaje 
                    FROM rankings 
                    JOIN usuarios ON rankings.usuario_id = usuarios.id 
                    WHERE rankings.juego_id = {$juego['id']}
                    ORDER BY rankings.puntaje DESC LIMIT 5
                ";

                $result_ranking = mysqli_query($conexion, $query_ranking);

                if (mysqli_num_rows($result_ranking) > 0) {
                    echo "<h4>Ranking de los Mejores Jugadores</h4>";
                    echo "<ul>";
                    while ($ranking = mysqli_fetch_assoc($result_ranking)) {
                        echo "<li>{$ranking['nombre']} - {$ranking['puntaje']} puntos</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No hay jugadores en el ranking todavía.</p>";
                }

                echo "</div>"; // Cierra el div de 'juego'
            }
        } else {
            echo "Debes iniciar sesión para ver la lista de juegos.";
        }
        ?>
    </div>
    

</section>

<?php include('footer.php'); ?>


