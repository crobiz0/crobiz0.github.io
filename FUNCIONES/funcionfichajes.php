<?php
function mostrarfichaje($con){
    $query = "SELECT NOMBRE_JUGADOR, EQUIPO_DE_ORIGEN, EQUIPO_DE_DESTINO, IMAGEN_JUGADOR FROM fichajes  ORDER BY ID_FICHAJE DESC ";
    $resultado = mysqli_query($con, $query);
return $resultado;

}

function equipoorigen($con,$equipoOrigen){
     // Consultas para obtener los IDs de los equipos
    $queryOrigen = "SELECT ID_EQUIPO FROM equipos WHERE NOMBRE = '$equipoOrigen'";
    $resultOrigen = mysqli_query($con, $queryOrigen);
    $idOrigen = mysqli_fetch_assoc($resultOrigen)['ID_EQUIPO'];
    return $idOrigen;
}
function equipodestino($con, $equipoDestino){
    $queryDestino = "SELECT ID_EQUIPO FROM equipos WHERE NOMBRE = '$equipoDestino'";
    $resultDestino = mysqli_query($con, $queryDestino);
    $idDestino = mysqli_fetch_assoc($resultDestino)['ID_EQUIPO'];
    return $idDestino;
}
