<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>SUBIR TABLA DE CLASIFICACION</h1>
<?php
    include('conexion.php');
    //Consulta para obtener la clasificación actual
    $con = conectar_bd(); // Asegúrate de tener la conexión aquí
    $sql = "SELECT e.ID_EQUIPO, e.NOMBRE, c.PARTIDOS_JUGADOS, c.PARTIDOS_GANADOS, c.PARTIDOS_EMPATADOS, c.PARTIDOS_PERDIDOS, c.GOLES_A_FAVOR, c.GOLES_ENCONTRA, c.PUNTOS FROM clasificacion c, equipos e WHERE c.ID_EQUIPO = e.ID_EQUIPO";
    $resultado = mysqli_query($con, $sql);
?>
<center>
<form method="POST" action="actualizar_tablaclasificacion.php">
    <table>
        <thead>
            <tr>
                <th>Equipo</th>
                <th>PJ</th>
                <th>PG</th>
                <th>PE</th>
                <th>PP</th>
                <th>GF</th>
                <th>GC</th>
                <th>Puntos</th>
            </tr> 
        </thead>
        <tbody class="tablaadmin">
            <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $row['NOMBRE']; ?></td>
                <td><input type="number" name="jugados[<?php echo $row['ID_EQUIPO']; ?>]" value="<?php echo $row['PARTIDOS_JUGADOS']; ?>"></td>
                <td><input type="number" name="ganados[<?php echo $row['ID_EQUIPO']; ?>]" value="<?php echo $row['PARTIDOS_GANADOS']; ?>"></td>
                <td><input type="number" name="empatados[<?php echo $row['ID_EQUIPO']; ?>]" value="<?php echo $row['PARTIDOS_EMPATADOS']; ?>"></td>
                <td><input type="number" name="perdidos[<?php echo $row['ID_EQUIPO']; ?>]" value="<?php echo $row['PARTIDOS_PERDIDOS']; ?>"></td>
                <td><input type="number" name="goles_favor[<?php echo $row['ID_EQUIPO']; ?>]" value="<?php echo $row['GOLES_A_FAVOR']; ?>"></td>
                <td><input type="number" name="goles_contra[<?php echo $row['ID_EQUIPO']; ?>]" value="<?php echo $row['GOLES_ENCONTRA']; ?>"></td>
                <td><input type="number" name="puntos[<?php echo $row['ID_EQUIPO']; ?>]" value="<?php echo $row['PUNTOS']; ?>"></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table> 
    <input type="submit" value="Actualizar Clasificación">
</form>
</center>
<a href="admin.php" class="button-link">Volver Pagina Admin</a>
</body>