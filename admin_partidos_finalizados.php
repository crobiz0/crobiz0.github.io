<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<br><h1>Subir Partido Finalizado</h1>
<?php
    include('conexion.php');
        $con = conectar_bd(); ?>
        <center>
    <form id="formpartidoF" name="form_partidoF" method="post" action="subir_partidosF.php">
        <label for="equipo_localf">Equipo Local:</label>
        <select name="equipo_localf" id="equipo_localf" required>
       
        <?php
        $query = "SELECT ID_EQUIPO, NOMBRE FROM equipos";
        $resultado = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($resultado)) {
            $nombre = $row['NOMBRE'];
            echo '<option value="' . $nombre . '">' . $nombre . '</option>';
        }
        mysqli_close($con);
        ?>
        </select>
        <br>

        <label for="equipo_visitantef">Equipo Visitante:</label>
        <select name="equipo_visitantef" id="equipo_visitantef" required>
        <?php
        // Reusar la conexión a la base de datos
        $con = conectar_bd();
        $resultado2 = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($resultado2)) {
            $nombre = $row['NOMBRE'];
            echo '<option value="' . $nombre . '">' . $nombre . '</option>';
        }
        mysqli_close($con);
        ?>
        </select>
        <br>

        <label for="resultado">Resultado:</label>
        <input type="text" name="resultado" id="resultado" placeholder="Ej: 2-1" required><br>

        <br>
    <label for="estadio">Estadio:</label>
    <input type="text" name="estadio" id="estadio" required>

    <br>
    <label for="fecha_hora">Fecha y Hora:</label>
    <input type="datetime-local" name="fecha_hora" id="fecha_hora" required>
    <br>
        <input type="hidden" name="tipo" value="FINALIZADO">

        <br>
    <input type="submit" value="Subir Partido" name="envio">
    <input type="reset" value="Cancelar">
    </form>
    </center>
    <a href="admin.php" class="button-link">Volver Pagina Admin</a>

</body>