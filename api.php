<?php

require("procesarAPI.php");

$API_paises = "https://apiv3.apifootball.com/?action=get_standings&league_id=152&APIkey=c7dc00e652a7b9129b7ad063c019fa5218d6fb468e3636b3d1e3454a707fd77f";

$tablaclasificacion = procesar_datos_API($API_paises);

// Asegúrate de que $tablaclasificacion sea un array antes de iterar
if (is_array($tablaclasificacion)) {

    ?>

    <?php require("header.php"); ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tablas de Clasificacion</title>
    </head>
    <body>
        
    <section>
        <div class="container-paises">

            <section>
                <h1>Tabla de Clasificacion</h1>
            </section>

            <?php foreach ($tablaclasificacion as $tabla): ?>

            <!-- Accediendo correctamente a los datos dentro del array -->
            <h2 class="equipo"> <?= $tabla['team_country'] . " - " . $tabla['team_name']; ?> </h2>

            <div class="contenedor-imagen">
                <img class="imagen" src="<?= $tabla['team_badge']; ?>" alt="Bandera de <?= $tabla['team_name']; ?>">
            </div>

            <?php endforeach; ?>

        </div>
    </section>

    </body>
    </html>

    <?php
} else {
    echo "Error al procesar los datos de la API.";
}
