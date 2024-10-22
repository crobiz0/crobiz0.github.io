<?php
require('conexion.php');
$con = conectar_bd();

if (isset($_GET['id'])) {  //comprueba si hay una id
    $id = intval($_GET['id']); //intval convierte el id en un número entero
    
    // Consulta directa y sencilla
    $query = "SELECT ESCUDO, FORMATO FROM equipos WHERE ID_EQUIPO = $id";
    $resultado = mysqli_query($con, $query); //ejecuta consulta
    
    if ($row = mysqli_fetch_assoc($resultado)) {
        $escudo = $row['ESCUDO'];
        $formato = $row['FORMATO'];

        if (!empty($escudo) && !empty($formato)) {
            // Enviar el tipo de contenido correcto
            header("Content-Type: $formato"); //se aasegura que la imagen se muestre correctamente en el navegador
            echo $escudo;
        }
    }
}

mysqli_close($con);
?>
