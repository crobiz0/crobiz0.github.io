<?php
function obtenerpartidosP($con){
$query = "SELECT EQUIPO_LOCAL, EQUIPO_VISITANTE, ESTADIO, FECHA_HORA FROM partidos WHERE TIPO = 'PRÓXIMO' ORDER BY ID_PARTIDOS DESC";
$resultados = mysqli_query($con, $query);
return $resultados;
}

 // Consultas para obtener los IDs de los equipos
 function equipolocal($con, $equipoLocal){
    $queryLocal = "SELECT ID_EQUIPO FROM equipos WHERE NOMBRE = '$equipoLocal'";
    $resultadoLocal = mysqli_query($con, $queryLocal);
    $idLocal = mysqli_fetch_assoc($resultadoLocal)['ID_EQUIPO'];
    return $idLocal;
}
function equipovisitante($con, $equipoVisitante){
    $queryVisitante = "SELECT ID_EQUIPO FROM equipos WHERE NOMBRE = '$equipoVisitante'";
    $resultadoVisitante = mysqli_query($con, $queryVisitante);
    $idVisitante = mysqli_fetch_assoc($resultadoVisitante)['ID_EQUIPO'];
    return $idVisitante;
}

?>