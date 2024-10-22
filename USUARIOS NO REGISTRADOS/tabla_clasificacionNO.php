<?php
require("headerNO.php");
require ("../conexion.php");
require("../FUNCIONES/funcion_tablaclasificacion.php");

$con = conectar_bd();

$resultado = obtenertablaclasificacion($con);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Clasificación de Equipos</title>
</head>
<body class="tablaclasificacion">
    <h1 style="color:white">Tabla de Clasificación de Equipos</h1>
    <table class="titulostabla">
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Escudo</th> <!-- Foto del equipo -->
                <th>PJ</th> <!-- Partidos Jugados -->
                <th>PG</th> <!-- Partidos Ganados -->
                <th>PE</th> <!-- Partidos Empatados -->
                <th>PP</th> <!-- Partidos Perdidos -->
                <th>GF</th> <!-- Goles a Favor -->
                <th>GC</th> <!-- Goles en Contra -->
                <th>DG</th> <!-- Diferencia de Goles -->
                <th>Puntos</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultado)): 
                // Calcular la diferencia de goles
                $diferencia_goles = $row['GOLES_A_FAVOR'] - $row['GOLES_ENCONTRA']; 
                
                // Mostrar la foto si existe
                if (!empty($row['ESCUDO'])) {
                    $fotoBase64 = base64_encode($row['ESCUDO']); // Asumiendo que FOTO es BLOB
                    $escudo = "<img src='data:image/jpeg;base64,{$fotoBase64}' alt='Escudo del equipo' />";
                } else {
                    // Si no hay foto, muestra una imagen por defecto
                    $escudo = "<img src='escudodefecto.jpg' alt='Escudo por defecto' />";
                }
            ?>
            <tr class="datostabla">
                <td><?php echo $row['NOMBRE']; ?></td>
                <td><?php echo $escudo; ?></td> <!-- Mostrar la foto del equipo -->
                <td><?php echo $row['PARTIDOS_JUGADOS']; ?></td>
                <td><?php echo $row['PARTIDOS_GANADOS']; ?></td>
                <td><?php echo $row['PARTIDOS_EMPATADOS']; ?></td>
                <td><?php echo $row['PARTIDOS_PERDIDOS']; ?></td>
                <td><?php echo $row['GOLES_A_FAVOR']; ?></td>
                <td><?php echo $row['GOLES_ENCONTRA']; ?></td>
                <td><?php echo $diferencia_goles; ?></td> <!-- Diferencia de goles calculada -->
                <td><?php echo $row['PUNTOS']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php require("../footer.php"); ?>
</body>
</html>