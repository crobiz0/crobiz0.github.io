<?php
require("headerNO.php");
require("../conexion.php");
require("../FUNCIONES/funcionNoticias.php");

// Crear la conexión a la base de datos
$con = conectar_bd();
// Obtener todas las noticias al cargar la página por primera vez
$resultado = obtenernoticia($con);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CROBIGOL</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>
<body class="NOTICIAS">
    <main>
        <h1 class="noticias" style="color: #ffffff;">NOTICIAS</h1>

        <center>
        <form action="noticiasNO.php" method="GET" class="buscador" onsubmit="buscarNoticias(); return false;">
        <input type="text" id="buscar" name="buscar" placeholder="Buscar noticias por título..." onkeyup="buscarNoticias()" />
        </form>
        </center>
        <section class="noticias" id="resultados">

        <?php if ($resultado->num_rows > 0): ?>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <div class="noticia" id="resultados">
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
                <p>No se encontraron noticias para la búsqueda "<?php echo htmlspecialchars($buscar); ?>".</p>
            <?php endif; ?>
        </section>
        <a class="arriba" href="#top"><i class="fa-solid fa-arrow-up" style="color: #2ff40a;"></i></a>
    </main>
    <?php require("../footer.php"); ?>
    <script src="../buscador_noticias.js"></script>
</body>
</html>