<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>SUBIR PARTIDO</h1>
<br>
<h1>Seleccionar Equipo Local</h1>
<br>

<center>
<?php
include('conexion.php');
$con = conectar_bd();

$query = "SELECT ID_EQUIPO, NOMBRE FROM equipos";
$resultado = mysqli_query($con, $query);
?>

<form id="formpartido" name="form_partido" method="post" action="subir_partidos.php">
    <label for="equipo_local">Equipo Local:</label>
    <select name="equipo_local" id="equipo_local" required>
    <?php
    while ($row = mysqli_fetch_assoc($resultado)) {
        $id = $row['ID_EQUIPO'];
        $nombre = $row['NOMBRE'];
        echo '<option value="' . $nombre . '">' . $nombre . '</option>';
    }
    ?>
</select>

<h1>Seleccionar Equipo Visitante</h1>
    <?php
    // Realizar una segunda consulta para los equipos
    $resultado2 = mysqli_query($con, $query);
    ?>
    <select name="equipo_visitante" id="equipo_visitante" required>
        <?php
        while ($row = mysqli_fetch_assoc($resultado2)) {
            $id = $row['ID_EQUIPO'];
            $nombre = $row['NOMBRE'];
            echo '<option value="' . $nombre . '">' . $nombre . '</option>';
        }
        ?>
    </select>
    <br>
    <label for="estadio">Estadio:</label>
    <input type="text" name="estadio" id="estadio" required>

    <br>
    <label for="fecha_hora">Fecha y Hora:</label>
    <input type="datetime-local" name="fecha_hora" id="fecha_hora" required>
    <br>
    <input type="hidden" name="tipo" value="PROXIMO">

    <br>
    <input type="submit" value="Subir Partido" name="envio">
    <input type="reset" value="Cancelar">
</form>
</center>
<a href="admin.php" class="button-link">Volver Pagina Admin</a>

</body>