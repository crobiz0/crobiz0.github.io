<?php
// Consulta para obtener los partidos finalizados, incluyendo FECHA_HORA y ESTADIO
function obtenerpartidosF($con){
$queryFinalizados = "SELECT ID_PARTIDOS, EQUIPO_LOCAL, EQUIPO_VISITANTE, RESULTADO, FECHA_HORA, ESTADIO FROM partidos WHERE TIPO = 'FINALIZADO' ORDER BY ID_PARTIDOS DESC";
$resultadosFinalizados = mysqli_query($con, $queryFinalizados);
return $resultadosFinalizados;

}
//Consultas para obtener los IDs de los equipos
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