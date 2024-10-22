<?php

function obtenertablaclasificacion($con){

$sql= "SELECT e.NOMBRE, e.ESCUDO, c.PARTIDOS_JUGADOS, c.PARTIDOS_GANADOS, c.PARTIDOS_EMPATADOS, c.PARTIDOS_PERDIDOS, c.GOLES_A_FAVOR, c.GOLES_ENCONTRA, c.PUNTOS FROM equipos e, clasificacion c WHERE e.ID_EQUIPO = c.ID_EQUIPO ORDER BY c.PUNTOS DESC";

$resultado = mysqli_query($con,$sql);

  // Verificar si la consulta fue exitosa
  if (!$resultado) {
    die("Error en la consulta: ". mysqli_error($con));
}

return $resultado;
}
?>