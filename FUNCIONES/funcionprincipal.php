<?php
function funcionprincipal($con){
    $sql = "SELECT ID_NOTICIAS, TITULO, IMAGEN_N, FECHA_PUBLICACION, CONTENIDO FROM Noticias ORDER BY FECHA_PUBLICACION DESC LIMIT 3";
$resultado = mysqli_query($con, $sql);

return $resultado; // Retornar el resultado de la consulta
} 
?>