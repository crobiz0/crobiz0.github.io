<?php
function obtenerComentarios($con, $post_id) {
    // Obtener los comentarios del post
    $sql = "SELECT ID_COMENTARIO, comentario, ID_USUARIO, fecha_comentario FROM comentarios WHERE ID_POST = '$post_id' ORDER BY ID_COMENTARIO DESC";
    $resultado = mysqli_query($con, $sql);
    $comentarios = [];

    while ($comentario = mysqli_fetch_assoc($resultado)) {
        // Obtener el nombre completo del usuario correspondiente
        $id_usuario= $comentario['ID_USUARIO'];
        $user_sql = "SELECT NOMBRE_COMPLETO FROM usuarios WHERE ID_USUARIO = '$id_usuario'";
        $user_result = mysqli_query($con, $user_sql);
        $user = mysqli_fetch_assoc($user_result);
        
        // Añadir el nombre completo al comentario
        $comentario['NOMBRE_COMPLETO'] = $user ? $user['NOMBRE_COMPLETO'] : 'Usuario desconocido';
        $comentarios[] = $comentario;
    }
    return $comentarios; // Retornar todos los comentarios con el nombre completo
}
function obtenerPost($con, $post_id) {
    // Obtener un post específico
    $sql = "SELECT ID_POST, titulo, contenido, ID_USUARIO, fecha_post FROM post WHERE ID_POST = '$post_id'";
    $resultado = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($resultado); // Retorna como un array asociativo
}

function obtenerNombreUsuario($con, $id_usuario) {
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
function insertarComentario($con, $post_id, $comentario, $id_usuario) {
    // Establecer la zona horaria
date_default_timezone_set('America/Montevideo');
     // Obtener la fecha actual
    $fecha_comentario = date('Y-m-d H:i');
    // Insertar el comentario en la base de datos
    $sql = "INSERT INTO comentarios (ID_POST, comentario, ID_USUARIO, fecha_comentario) VALUES ('$post_id', '$comentario', '$id_usuario', '$fecha_comentario')";
    if (mysqli_query($con, $sql)) {
        return true;
    } else {
        return false;
    }
}
function editarComentario($con, $comentario_id, $nuevo_comentario, $id_usuario) {
    // Verificar que el comentario pertenece al usuario
    $sql = "SELECT * FROM comentarios WHERE ID_COMENTARIO = '$comentario_id' AND ID_USUARIO = '$id_usuario'";
    $resultado = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($resultado) > 0) {
        // Actualizar el comentario
        $sql= "UPDATE comentarios SET comentario = '$nuevo_comentario' WHERE ID_COMENTARIO = '$comentario_id'";
        return mysqli_query($con, $sql);
    } else {
        // Si el comentario no pertenece al usuario actual
        return false;
    }
}
function obtenerComentarioPorId($con, $comentario_id, $id_usuario) {
    // Consulta para obtener el comentario por su ID y verificar que pertenece al usuario
    $sql = "SELECT * FROM comentarios WHERE ID_COMENTARIO = '$comentario_id' AND ID_USUARIO = '$id_usuario'";
    $resultado = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($resultado); // Retorna el comentario o null si no lo encuentra
}
function borrarComentario($con, $comentario_id, $id_usuario) {
    // Verificar que el comentario pertenece al usuario
    $sql = "SELECT * FROM comentarios WHERE ID_COMENTARIO = '$comentario_id' AND ID_USUARIO = '$id_usuario'";
    $resultado = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($resultado) > 0) {
        // Borrar el comentario
        $sql = "DELETE FROM comentarios WHERE ID_COMENTARIO = '$comentario_id'";
        return mysqli_query($con, $sql);
    } else {
        // Si el comentario no pertenece al usuario actual
        return false;
    }
}
?>