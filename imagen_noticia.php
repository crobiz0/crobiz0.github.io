<?php
require('conexion.php');

$con = conectar_bd();

if (isset($_GET['id'])) { //comprueba si hay una id
    $id = intval($_GET['id']); //intval convierte el id en un número entero
    
    $sql = "SELECT IMAGEN_N FROM Noticias WHERE ID_NOTICIA = $id"; //hace la consulta
    $resultado = mysqli_query($con, $sql);//ejecuta la consulta

    if ($row = mysqli_fetch_assoc($resultado)) { //verifica si la consulta devolvio una fila de resultados 
        header("Content-Type: image/jpeg"); // el contenido se trata como formato imagen
        echo $row['IMAGEN_N'];
    } else {
        echo "Imagen no encontrada.";
    }
}

mysqli_close($con);
?>
