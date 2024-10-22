<?php
require("headerNO.php");
require("../conexion.php");
require ("../FUNCIONES/funcionprincipal.php");

// Crear la conexión a la base de datos
$con = conectar_bd();

// Obtener las noticias desde la base de datos
$resultado = funcionprincipal($con);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CROBIGOL</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="principal">
    <main>
        <center> <img class="empresa" src="../IMAGENES/logo empresa.png" alt="CROBIGOL"></center>
<div class="quienes">
<h2>Quienes somos</h2>
<h2>Somos un sitio web que esta enfocado para todos los aficionados al fútbol sanducero que desean estar al tanto de las últimas novedades en fichajes y conocer los horarios de los partidos.</h2>
</div>
        <section class="noticias-destacadas">
            <h2>Noticias Destacadas</h2>
            <?php if ($resultado->num_rows > 0): ?>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <div class="noticia">
                    <div class="imagen-noticia">
                        <?php
                        // Mostrar la imagen
                        $imagenData = $row['IMAGEN_N'];
                        $imagenBase64 = base64_encode($imagenData);
                        echo "<img src='data:image/jpeg;base64," . $imagenBase64 . "' alt='Imagen de noticia' />";
                        ?>
                    </div>
                        <p><?php echo htmlspecialchars($row['TITULO']); ?></p>
                        <p>Subido el: <?php echo htmlspecialchars($row['FECHA_PUBLICACION']); ?></p>
                        <a href="noticia_completaNO.php?id=<?php echo $row['ID_NOTICIAS']; ?>" target="_blank" class="leer_mas">Leer Más</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay noticias disponibles.</p>
            <?php endif; ?>
        </section>
    </main>
    <?php require("../footer.php"); ?>
</body>
</html>