<?php
require ("conexion.php");


function actualizartablaclasificacion($con, $data) {
    // Comprobar si hay datos para actualizar
    if (empty($data['puntos'])) {
        return;
    }

    // Recorrer los datos de los equipos enviados desde el formulario
    foreach ($data['puntos'] as $id_equipo => $puntos) {
        // Obtener los datos de los demás campos
        $jugados = $data['jugados'][$id_equipo] ?? 0;
        $ganados = $data['ganados'][$id_equipo] ?? 0;
        $empatados = $data['empatados'][$id_equipo] ?? 0;
        $perdidos = $data['perdidos'][$id_equipo] ?? 0;
        $goles_favor = $data['goles_favor'][$id_equipo] ?? 0;
        $goles_contra = $data['goles_contra'][$id_equipo] ?? 0;

        // Construir la consulta SQL para actualizar los datos del equipo
        $query = "UPDATE clasificacion SET PUNTOS = '$puntos', PARTIDOS_JUGADOS = '$jugados', PARTIDOS_GANADOS = '$ganados', PARTIDOS_EMPATADOS = '$empatados',  PARTIDOS_PERDIDOS = '$perdidos', GOLES_A_FAVOR = '$goles_favor', GOLES_ENCONTRA = '$goles_contra' WHERE ID_EQUIPO = '$id_equipo'";

        // Ejecutar la consulta
        mysqli_query($con, $query);
    }
}

// Verificar si el método de la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Llamar a la función para actualizar la clasificación
    actualizartablaclasificacion($con, $_POST);

    // Redirigir a la página de clasificación o mostrar un mensaje de éxito
    header('Location: tabla_clasificacion.php');
    exit(); // Asegurarse de que no se ejecute más código después de la redirección
}
?>