<?php
session_start(); // Inicia la sesión
require("conexion.php");
require("./FUNCIONES/funcionforo.php");

// Crear la conexión a la base de datos
$con = conectar_bd();

// Capturar el término de búsqueda enviado por AJAX
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Obtener posts por título si se ingresó una búsqueda, de lo contrario obtener todos
if (!empty($buscar)) {
    $resultado = obtenerpostportitulo($con, $buscar);
} else {
    $resultado = obtenerTodosLosPosts($con);
}
// Mostrar los resultados en formato HTML para ser inyectados con AJAX
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        // Obtener el nombre del usuario basado en el ID_USUARIO
        $usuario_nombre = obtenerNombreUsuarioForo($con, $row['ID_USUARIO']);
        
        echo '<div class="discusion">';
        echo '<h2>';
        
        // Verificar si el usuario está registrado y cambiar el enlace según corresponda
        if (isset($_SESSION['email'])) {
            // Usuario registrado
            echo '<a href="post.php?id=' . $row['ID_POST'] . '">' . htmlspecialchars($row['titulo']) . '</a>';
            echo '<p>Publicado por <a href="perfilcomun.php?id=' . $row['ID_USUARIO'] . '">' . htmlspecialchars($usuario_nombre) . '</a></p>';
        } else {
            // Usuario no registrado
            echo '<a href="postNO.php?id=' . $row['ID_POST'] . '">' . htmlspecialchars($row['titulo']) . '</a>';
            echo '<p>Publicado por <a href="perfilcomunNO.php?id=' . $row['ID_USUARIO'] . '">' . htmlspecialchars($usuario_nombre) . '</a></p>';
        }
        echo '</h2>';
        echo '</div>';
    }
} else {
    echo '<p class="noposts">No se encontraron posts para la búsqueda "' . htmlspecialchars($buscar) . '".</p>';
}
?>