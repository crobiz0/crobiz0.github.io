<?php
function obtenerTodosLosPosts($con) {
    // Consulta SQL para obtener todos los posts
    $sql = "SELECT p.ID_POST, p.titulo, p.contenido, p.ID_USUARIO, p.fecha_post, u.NOMBRE_COMPLETO FROM post p, usuarios u WHERE p.ID_USUARIO = u.ID_USUARIO  ORDER BY ID_POST DESC";
    
    // Ejecutar la consulta y retornar el resultado
    return mysqli_query($con, $sql);
}

function obtenerNombreUsuarioForo($con, $id_usuario) {
    // Consulta SQL para obtener el nombre completo del usuario
    $sql = "SELECT NOMBRE_COMPLETO FROM usuarios WHERE ID_USUARIO = '$id_usuario'";
    $resultado = mysqli_query($con, $sql);

    // Verificar si se obtuvo el resultado
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        return $usuario['NOMBRE_COMPLETO'];
    } else {
        return 'Usuario desconocido'; // Si no se encuentra el usuario
    }
}

function obtenerpostportitulo($con, $titulo) {
    // Consulta SQL para buscar noticias por título
    $sql = "SELECT ID_POST, titulo, contenido, ID_USUARIO, fecha_post FROM post WHERE titulo LIKE '%$titulo%' ORDER BY ID_POST DESC";
    $resultado = mysqli_query($con, $sql);
    return $resultado;
}
?>