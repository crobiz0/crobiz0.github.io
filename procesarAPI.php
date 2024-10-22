<?php

function procesar_datos_API($api) {

    // Inicia la petición
    $inicio = curl_init($api);

    // Detiene la ejecución si hay un error en el cURL
    curl_setopt($inicio, CURLOPT_RETURNTRANSFER, true);

    // Ejecuta la petición
    $resultado = curl_exec($inicio);

    // Cierra el recurso cURL
    curl_close($inicio);

    // Convierte el resultado del JSON a array asociativo
    $datos = json_decode($resultado, true);

    return $datos;
}
