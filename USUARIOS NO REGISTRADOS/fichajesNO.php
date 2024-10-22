<?php
require("headerNO.php");
require("../conexion.php");
require ("../FUNCIONES/funcionfichajes.php");


$con = conectar_bd();
$resultado = mostrarfichaje($con);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CROBIGOL</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="fichajes">
<main>
    <h1 style="color: white; text-align: center;">FICHAJES</h1>
    <div class="fichajes-container">
    <?php while ($row = mysqli_fetch_assoc($resultado)) { 
            $jugador = $row['NOMBRE_JUGADOR'];
            $equipoOrigen = $row['EQUIPO_DE_ORIGEN'];
            $equipoDestino = $row['EQUIPO_DE_DESTINO'];
            $imagenJugador = $row['IMAGEN_JUGADOR'];

              // Usamos las funciones para obtener los IDs de los equipos
        $idOrigen = equipoorigen($con, $equipoOrigen);
        $idDestino = equipodestino($con, $equipoDestino);
        ?>
<div class="fichaje">
            <div class="equipo">
                <div class="escudo">
                    <img src="../escudo.php?id=<?php echo $idOrigen; ?>" alt="Escudo" >
                </div>
                <p><?php echo htmlspecialchars($equipoOrigen); ?></p>
            </div>
            <div class="flecha">
                <img src="../IMAGENES/flecha.png" alt="Flecha">
            </div>
            <div class="jugador">
                <div class="foto">
                <?php if (!empty($imagenJugador)): ?>
                        <?php
                        $fotoBase64 = base64_encode($imagenJugador);
                        echo "<img src='data:image/jpeg;base64,$fotoBase64' alt='Foto del Jugador' />";
                        ?>
                    <?php else: ?>
                        <img src="../IMAGENES/perfildefault.jpg" alt="Foto de perfil" />
                    <?php endif; ?>
                </div>
                <p><?php echo htmlspecialchars($jugador); ?></p>
            </div>
            <div class="flecha">
                <img src="../IMAGENES/flecha.png" alt="Flecha">
            </div>
            <div class="equipo">
                <div class="escudo">
                    <img src="../escudo.php?id=<?php echo $idDestino; ?>" alt="Escudo">
                </div>
                <p><?php echo htmlspecialchars($equipoDestino); ?></p>
            </div>
            <center><p>El jugador <?php echo htmlspecialchars($jugador); ?> pasa del Equipo <?php echo htmlspecialchars($equipoOrigen); ?> al Equipo <?php echo htmlspecialchars($equipoDestino); ?></p>
</center>
        </div>
        <?php } ?>
    </div>
    <a class="arriba" href="#top"><i class="fa-solid fa-arrow-up" style="color: #2ff40a;"></i></a>

</main>
<?php require("../footer.php"); ?>
</body>
</html>
<?php mysqli_close($con); ?>