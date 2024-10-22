<?php
// Obtener las noticias desde la base de datos
function obtenernoticia($con){
$sql = "SELECT ID_NOTICIAS, TITULO, IMAGEN_N, FECHA_PUBLICACION, CONTENIDO FROM Noticias ORDER BY ID_NOTICIAS DESC"; //lo ordena de forma descendente
$resultado = mysqli_query($con, $sql);
return $resultado;
}

// Obtener noticias según el título
function obtenernoticiaportitulo($con, $titulo) {
    // Consulta SQL para buscar noticias por título
    $sql = "SELECT ID_NOTICIAS, TITULO, IMAGEN_N, FECHA_PUBLICACION FROM Noticias WHERE TITULO LIKE '%$titulo%' ORDER BY FECHA_PUBLICACION DESC";
    $resultado = mysqli_query($con, $sql);
    return $resultado;
}
?>