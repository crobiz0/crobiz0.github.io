<?php
require("conexion.php");
$con = conectar_bd();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['equipo_localf']) && isset($_POST['equipo_visitantef']) && isset($_POST['resultado'])) {
        $equipo_localf = $_POST['equipo_localf'];
        $equipo_visitantef = $_POST['equipo_visitantef'];
        $resultado = $_POST['resultado'];
        $estadio = $_POST['estadio'];
        $fechaHora = $_POST['fecha_hora'];
        // Insertar los datos en la tabla de partidos finalizados
        $sql = "INSERT INTO partidos (EQUIPO_LOCAL, EQUIPO_VISITANTE, RESULTADO, ESTADIO, FECHA_HORA, TIPO) 
                VALUES ('$equipo_localf', '$equipo_visitantef', '$resultado','$estadio','$fechaHora', 'FINALIZADO')";

        if (mysqli_query($con, $sql)) {
            echo "Partido finalizado subido con éxito.";
            header("Refresh: 2; url=/admin.php");
            exit();
        } else {
            echo "Error al subir el partido: " . mysqli_error($con);
            }
        }
    mysqli_close($con);
}
?>