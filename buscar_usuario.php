<?php
require("conexion.php");

// Indicar que la respuesta de este PHP es un JSON
header('Content-Type: application/json');

$con = conectar_bd();

// Defino un array para devolver las respuestas JSON según cada caso
$respuesta_json = array();

if (isset($_POST["envio"])) {
    $nombre = $_POST["usuario"];

    // Llamada a la función login
    $resultado_busqueda = buscar_usuario($con, $nombre);

    // Devuelvo la respuesta en formato JSON
    echo json_encode($resultado_busqueda);
}

function buscar_usuario($con, $nombre) {
    // Array para almacenar la respuesta
    $respuesta_json = array();
    $usuarios = array();

    // Sanitizar el nombre para evitar inyecciones SQL
    $nombre = mysqli_real_escape_string($con, $nombre);

    // Consulta para buscar el usuario
    $consulta_buscar_user = "SELECT ID_USUARIO, NOMBRE_COMPLETO, CORREO_ELECTRONICO, ESTA_BLOQUEADO FROM usuarios WHERE NOMBRE_COMPLETO LIKE '$nombre%' ";
    $resultado_buscar_user = mysqli_query($con, $consulta_buscar_user);

    if (mysqli_num_rows($resultado_buscar_user) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado_buscar_user)) {

            // Agregar cada usuario encontrado al array
            $usuarios[] = array(
                "id" => $fila["ID_USUARIO"],
                "nombre" => $fila["NOMBRE_COMPLETO"],
                "email" => $fila["CORREO_ELECTRONICO"],
                "esta_bloqueado" => $fila["ESTA_BLOQUEADO"]
            );
        }
        $respuesta_json['status'] = 1; // se encontró el usuario
        $respuesta_json['usuarios'] = $usuarios;
    } else {
        $respuesta_json['status'] = 0; // no se encontró
        $respuesta_json['mensaje'] = "No se encontraron usuarios.";
    }

    return $respuesta_json;
}
