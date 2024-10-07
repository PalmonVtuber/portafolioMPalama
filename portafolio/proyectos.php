<?php
include('header.php'); 
include('conexion.php'); // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enlace'])) {
    $enlaceOriginal = $_POST['enlace'];

    // Verificar si el enlace está en el formato correcto
    if (filter_var($enlaceOriginal, FILTER_VALIDATE_URL)) {
        // Insertar el enlace en la base de datos
        $sql = "INSERT INTO enlaces (enlace_original) VALUES ('$enlaceOriginal')";
        if (mysqli_query($conexion, $sql)) {
            $id = mysqli_insert_id($conexion); // Obtener el ID insertado
            $codigoAcortado = base_convert($id, 10, 36); // Convertir a base 36 para acortar

            // Actualizar la base de datos con el código acortado
            $sqlUpdate = "UPDATE enlaces SET enlace_acortado = '$codigoAcortado' WHERE id = $id";
            mysqli_query($conexion, $sqlUpdate);

            // Mostrar el enlace acortado al usuario
            echo "<p>a href='http://localhost/portafolio/redirect.php?codigo=$codigoAcortado'>http://localhost/portafolio/$codigoAcortado</a></p>";
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
    <div class="calculadora">
        <h3>Proyecto calculadora</h3>
        <p>Descripción breve del proyecto.</p>
        
        <form method="post" action="">
        <input type="number" name="num1" placeholder="Número 1">
        <input type="number" name="num2" placeholder="Número 2">
        <select name="operacion">
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
        </select>
        <input type="submit" value="Calcular">
        </form>

         <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $operacion = $_POST['operacion'];

                switch ($operacion) {
                    case 'suma':
                 $resultado = $num1 + $num2;
                    break;
                    case 'resta':
                 $resultado = $num1 - $num2;
                 break;
                case 'multiplicacion':
                $resultado = $num1 * $num2;
                break;
                case 'division':
                    if ($num2 == 0) {
                    $resultado = "No se puede dividir por cero";
                    } else {
                    $resultado = $num1 / $num2;
                    }
                    break;
        }

        echo "El resultado es: " . $resultado;
    }
    ?>

    </div>
    <div class="proyecto">
        <h3>Proyecto 2</h3>
        <p>Descripción breve del proyecto.</p>
    </div>
</section>

<?php include('footer.php'); ?>

