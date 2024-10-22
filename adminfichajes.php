<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<center>
<h1>SUBIR FICHAJE</h1>

<?php
include('conexion.php');
$con = conectar_bd();

$query = "SELECT ID_EQUIPO, NOMBRE FROM equipos";
$resultado = mysqli_query($con, $query);
?>

<form id="formfichaje" name="form2" method="post"  enctype="multipart/form-data" action="subir_fichaje.php">
    <label for="ffichaje">Nombre Jugador:</label>
    <input type="text" name="njugaddor" id="nombrejugador" required>

    <h2>Seleccionar Equipo De Origen</h2>
    <select name="Eanterior" id="e_origen">
    <?php
    while ($row = mysqli_fetch_assoc($resultado)) {
        $id = $row['ID_EQUIPO'];
        $nombre = $row['NOMBRE'];
        echo '<option value="' . $nombre . '">' . $nombre . '</option>';
    }
    ?>
    </select>

    <h2>Seleccionar Equipo de Destino</h2>
    <?php
    // Hacer una segunda consulta para los equipos
    $resultado2 = mysqli_query($con, $query);
    ?>
    <select name="Enuevo" id="e_destino">
        <?php
        while ($row = mysqli_fetch_assoc($resultado2)) {
            $id = $row['ID_EQUIPO'];
            $nombre = $row['NOMBRE'];
            echo '<option value="' . $nombre . '">' . $nombre . '</option>';
        }
        ?>
    </select>

    <br>
    <label for="imagenJ">Imagen de Jugador:</label>
    <input type="file" name="imagenjugador" id="imagenJ">

    <input type="submit" value="Subir Fichaje" name="envio">
    <input type="reset" value="Cancelar">
</form>
<a href="admin.php" class="button-link">Volver Pagina Admin</a>
</body>