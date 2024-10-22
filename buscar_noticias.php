<?php
session_start();
require("conexion.php");
require("./FUNCIONES/funcionNoticias.php");

// Crear la conexión a la base de datos
$con = conectar_bd();

// Capturar el término de búsqueda enviado por AJAX
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Obtener noticias por título si se ingresó una búsqueda, de lo contrario obtener todas
if (!empty($buscar)) {
    $resultado = obtenernoticiaportitulo($con, $buscar);
} else {
    $resultado = obtenernoticia($con);
}

// Mostrar los resultados en formato HTML para ser inyectados con AJAX
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        // Convertir la imagen a base64
        $imagenData = $row['IMAGEN_N'];
        $imagenBase64 = base64_encode($imagenData);

        echo '<div class="noticia">';
        echo '<div class="imagen-noticia">';
        echo '<img src="data:image/jpeg;base64,' . $imagenBase64 . '" alt="Imagen de noticia" />';
        echo '</div>';
        echo '<p>' . htmlspecialchars($row['TITULO']) . '</p>';
        echo '<p>Subido el: ' . htmlspecialchars($row['FECHA_PUBLICACION']) . '</p>';
  // Verificar si el usuario está registrado y cambiar el enlace según corresponda
  if (isset($_SESSION['email'])) {
    // Usuario registrado
    echo '<a href="noticia_completa.php?id=' . $row['ID_NOTICIAS'] . '" class="leer_mas">Leer Más</a>';
} else {
    // Usuario no registrado
    echo '<a href="noticia_completaNO.php?id=' . $row['ID_NOTICIAS'] . '" class="leer_mas">Leer Más</a>';
}
echo '</div>';
    }
} else {
    echo '<p class="nonoticias">No se encontraron noticias para la búsqueda "' . htmlspecialchars($buscar) . '".</p>';
}
?>
