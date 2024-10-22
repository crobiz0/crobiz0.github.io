<?php
require("conexion.php");
$con = conectar_bd();

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verifica si el formulario fue enviado mediante el método POST
    $fechaActual = date('Y-m-d');
    $titulo = $_POST["titulo"];
    $contenido = $_POST["contenido"];
    $imagen = $_FILES["imagen"]["tmp_name"]; //tmp_name le da una ubicacion temporal a la imagen
    $imagenData = null;     // Inicializa la variable de datos de la imagen

    if ($imagen) {
        $imagenData = file_get_contents($imagen);// Lee el contenido de la imagen
        $imagenData = mysqli_real_escape_string($con, $imagenData); // Escapar caracteres   especiales para evitar problemas en la consulta
    }

    subirNoticia($con, $titulo, $fechaActual, $imagenData, $contenido);
}

function verificarSesion() { 
    if (!isset($_SESSION['email'])) {  //pregunta si el usuario no tiene una sesión activa con el valor email
        header("Location: login.php");// Si no hay una sesión de email activa, te manda al login
        exit();
    }
}

function subirNoticia($con, $titulo, $fechaActual, $imagenData, $contenido) {
    if (!$con) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Escapar caracteres especiales en el título y el contenido
    $titulo = mysqli_real_escape_string($con, $titulo);
    $contenido = mysqli_real_escape_string($con, $contenido);

    $sql = "INSERT INTO Noticias (TITULO, IMAGEN_N, FECHA_PUBLICACION, CONTENIDO) VALUES ('$titulo', '$imagenData', '$fechaActual', '$contenido')";

    if (mysqli_query($con, $sql)) {
        echo "Noticia subida exitosamente.";
        header("Refresh: 2; url=/admin.php");
        exit();
    } else {
        echo "Error al subir la noticia: " . mysqli_error($con);
        header("Refresh: 2; url=/admin.php");
        exit();
    }
}
?>