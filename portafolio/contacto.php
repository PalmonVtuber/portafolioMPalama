<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('header.php'); ?>
    <body>
        
    
 
        <section id="contacto">
            <h1>Contacto</h1>
            <p>¡Me encantaría saber de ti! Completa el formulario a continuación para ponerte en contacto conmigo.</p>
            <div class="form-container">
                <form action="procesar_contacto.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Mensaje:</label>
                        <textarea id="mensaje" name="mensaje" rows="5" required></textarea>
                    </div>

                    <input type="submit" value="Enviar" class="btn-enviar">
                </form>
            </div>
        </section>
    
</body>
    <?php include('footer.php'); ?>
</body>
</html>
