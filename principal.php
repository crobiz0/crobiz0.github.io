<?php
require("header.php");
require("conexion.php");
require ("./FUNCIONES/funcionprincipal.php");
require("./FUNCIONES/funcionsesion.php");
// Crear la conexión a la base de datos
$con = conectar_bd();

// Verificar la sesión y obtener el email del usuario
$email = verificarSesion();
// Obtener las noticias desde la base de datos
$resultado = funcionprincipal($con);
?>

<body class="principal">
    <main>
        <center><img class="empresa" src="./IMAGENES/a.png" alt="CROBIGOL"></center>
        
        <div class="bienvenido">
            <h2>Bienvenido </h2> 
            <?php echo htmlspecialchars($email); ?>
        </div>

        <div class="quienes">
            <h2>Quienes somos</h2>
            <h2>Somos un sitio web que está enfocado para todos los aficionados al fútbol sanducero que desean estar al tanto de las últimas novedades en fichajes y conocer los horarios de los partidos.</h2>
        </div>

        <section class="noticias-destacadas">
            <h2>Noticias Destacadas</h2>

            <?php if ($resultado->num_rows > 0): ?> <!--solo se muestra si hay noticias-->
                <?php while ($row = $resultado->fetch_assoc()): ?> <!--muestra las noticias que se recuperaron de la bd
                -->         
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
                        <a href="noticia_completa.php?id=<?php echo $row['ID_NOTICIAS']; ?>" class="leer_mas">Leer Más</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay noticias disponibles.</p>
            <?php endif; ?>
        </section>
    </main>
    <?php require("footer.php"); ?>
</body>
</html>

