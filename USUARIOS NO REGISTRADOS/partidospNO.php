<?php
require("headerNO.php");
require("../conexion.php");
require("../FUNCIONES/funcionpartidosP.php");

$con = conectar_bd();

$resultados = obtenerpartidosP($con);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partidos Finalizados</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="partidos">
<main>
    <h1 style="color: white; text-align: center;">PROXIMOS PARTIDOS</h1>
    <center> <nav class="botonproximo">
            <ul>
            <li><a href="partidosfNO.php" class="botonP">PARTIDOS FINALIZADOS</a></li>
            </ul>
    </nav>
    </center>
    <div class="partidos-container">
    <?php while ($row = mysqli_fetch_assoc($resultados)) { 
            $equipoLocal = $row['EQUIPO_LOCAL'];
            $equipoVisitante = $row['EQUIPO_VISITANTE'];
            $estadio = $row['ESTADIO'];
            $fechaHora = $row['FECHA_HORA'];

        // Usamos las funciones para obtener los IDs de los equipos
        $idLocal = equipolocal($con, $equipoLocal);
        $idVisitante = equipovisitante($con, $equipoVisitante);
    ?>
        <div class="partido">
            <div class="equipo">
                <div class="escudo">
                    <img src="../escudo.php?id=<?php echo $idLocal; ?>" alt="Escudo Local">
                </div>
                <p><?php echo htmlspecialchars($equipoLocal); ?></p>
            </div>
            <div class="versus">
                <img src="../IMAGENES/vs.png" alt="Versus">
            </div>
            <div class="equipo">
                <div class="escudo">
                    <img src="../escudo.php?id=<?php echo $idVisitante; ?>" alt="Escudo Visitante">
                </div>
                <p><?php echo htmlspecialchars($equipoVisitante); ?></p>
            </div>
            <div class="detalles-partido">
                <p>Estadio: <?php echo htmlspecialchars($estadio); ?></p>
                <p>Fecha: <?php echo htmlspecialchars($fechaHora); ?></p>
            </div>
        </div>
    <?php } ?>
    </div>
</main>
<?php require("../footer.php"); ?>
</body>
</html>
<?php mysqli_close($con); ?>