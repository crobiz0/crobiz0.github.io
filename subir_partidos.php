<?php
require("conexion.php");
$con = conectar_bd();

if (isset($_POST['equipo_local'], $_POST['equipo_visitante'], $_POST['estadio'], $_POST['fecha_hora'])) { //verifica si hay valores
    // Obtener los datos del formulario
    $equipoLocal = $_POST['equipo_local'];
    $equipoVisitante = $_POST['equipo_visitante'];
    $estadio = $_POST['estadio'];
    $fechaHora = $_POST['fecha_hora'];
    // Subir los datos del partido
    subirPartido($con, $equipoLocal, $equipoVisitante, $estadio, $fechaHora);
}
function subirPartido($con, $equipoLocal, $equipoVisitante, $estadio, $fechaHora) {
    if (!$con) {
        die("Error de conexión: " . mysqli_connect_error());
    }
       // Crear la consulta SQL para insertar el partido
    $sql = "INSERT INTO partidos (EQUIPO_LOCAL, EQUIPO_VISITANTE, ESTADIO, FECHA_HORA, TIPO) 
    VALUES ('$equipoLocal', '$equipoVisitante', '$estadio', '$fechaHora', 'PROXIMO')";
// Ejecutar la consulta
if (mysqli_query($con, $sql)) {
echo "Partido subido exitosamente.";
header("Refresh: 2; url=/admin.php");
exit();
} else {
echo "Error al subir el partido: " . mysqli_error($con);
}
// Cerrar la conexión
mysqli_close($con);
}
?>