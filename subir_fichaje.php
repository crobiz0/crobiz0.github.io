<?php
require("conexion.php");
session_start();

$con = conectar_bd();
verificarSesion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreJugador = $_POST["njugaddor"];
    $equipoAnterior = $_POST["Eanterior"];
    $equipoNuevo = $_POST["Enuevo"];
    
    // Manejo de la imagen del jugador
    $imagenJugador = null; // inicia la variable como nula
    if (isset($_FILES['imagenjugador']) && $_FILES['imagenjugador']['error'] == UPLOAD_ERR_OK) { //verifica que fue cargada la imagen
        $imagenJugador = file_get_contents($_FILES['imagenjugador']['tmp_name']); //lee el contenido y lo almacena en $imagenjugador
    }

    subirFichaje($con, $nombreJugador, $equipoAnterior, $equipoNuevo, $imagenJugador);
}

function verificarSesion() {
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }
}

function subirFichaje($con, $nombreJugador, $equipoAnterior, $equipoNuevo , $imagenJugador) {
    if (!$con) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Manejar el caso de imagen nula
    if ($imagenJugador !== null) {
        $imagenJugador = mysqli_real_escape_string($con, $imagenJugador);
        $query = "INSERT INTO fichajes (NOMBRE_JUGADOR, EQUIPO_DE_ORIGEN, EQUIPO_DE_DESTINO, IMAGEN_JUGADOR) VALUES ('$nombreJugador', '$equipoAnterior', '$equipoNuevo', '$imagenJugador')";
    } else {
        $query = "INSERT INTO fichajes (NOMBRE_JUGADOR, EQUIPO_DE_ORIGEN, EQUIPO_DE_DESTINO) VALUES ('$nombreJugador', '$equipoAnterior', '$equipoNuevo')";
    }

    if (mysqli_query($con, $query)) {
        echo "Fichaje subido exitosamente.";
        header("Refresh: 2; url=/admin.php");
        exit();
    } else {
        echo "Error al subir el fichaje: " . mysqli_error($con);
        header("Refresh: 2; url=/admin.php");
        exit();
    }
}
?>