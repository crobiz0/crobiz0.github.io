<?php
require("conexion.php");
require("./FUNCIONES/funcionsesion.php"); // Archivo con la función verificarSesion

$email_usuario = verificarSesion(); // Obtener el email del usuario que está logueado

$con = conectar_bd(); // Conectar a la base de datos

// Verificar que se haya pasado un ID
if (isset($_GET['id'])) {
    $id_noticia = mysqli_real_escape_string($con, $_GET['id']); // Escapar el ID para evitar inyecciones SQL

    // Consulta para eliminar la noticia guardada
    $sql = "DELETE FROM noticias_guardadas WHERE ID_NOTICIAS = '$id_noticia' AND CORREO_ELECTRONICO = '$email_usuario'";
    mysqli_query($con, $sql); // Ejecutar la consulta
}

// Redirigir de vuelta al perfil
header("Location: perfil.php");
exit();
?>
