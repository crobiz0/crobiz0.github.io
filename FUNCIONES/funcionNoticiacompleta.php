<?php
function verificarVoto($con, $id, $email_usuario) {
    $sql = "SELECT * FROM Votos WHERE ID_NOTICIAS = $id AND EMAIL_USUARIO = '" . mysqli_real_escape_string($con, $email_usuario) . "'"; //hace la consulta y ademas se identifica al usuario en el sistema utilizando su email
    $resultado = mysqli_query($con, $sql);
    return mysqli_num_rows($resultado) > 0; //cuenta cuantas filas fueron devueltas por la consulta
}

function actualizarLikes($con, $id) {
    $sql = "UPDATE Noticias SET LIKES = LIKES + 1 WHERE ID_NOTICIAS = $id";
    mysqli_query($con, $sql);
}

function actualizarDislikes($con, $id) {
    $sql = "UPDATE Noticias SET DISLIKES = DISLIKES + 1 WHERE ID_NOTICIAS = $id";
    mysqli_query($con, $sql);
}

function registrarVoto($con, $id, $email_usuario, $voto) {
    $email_escapado = mysqli_real_escape_string($con, $email_usuario); //se identifica al usuario en el sistema utilizando su email
    $sql = "INSERT INTO Votos (ID_NOTICIAS, EMAIL_USUARIO, VOTO) VALUES ($id, '$email_escapado', '$voto')";
    mysqli_query($con, $sql);
}

function obtenerNoticia($con, $id) {
    $sql = "SELECT TITULO, IMAGEN_N, FECHA_PUBLICACION, CONTENIDO, LIKES, DISLIKES FROM Noticias WHERE ID_NOTICIAS = $id";
    $resultado = mysqli_query($con, $sql);
    if ($resultado && mysqli_num_rows($resultado) > 0) { //cuenta cuantas filas fueron devueltas por la consulta
        return mysqli_fetch_assoc($resultado); //verifica si la consulta devolvio una fila de resultados
    } else {
        die("Noticia no encontrada.");
    }
}

//FUNCIONES PARA GUARDAR LAS NOTICIAS Y PODER MOSTRARLAS EN EL PERFIL
function verificarGuardado($con, $id_noticia, $email_usuario) {
    $sql = "SELECT * FROM noticias_guardadas WHERE ID_NOTICIAS = $id_noticia AND CORREO_ELECTRONICO = '" . mysqli_real_escape_string($con, $email_usuario) . "'";
    $resultado = mysqli_query($con, $sql);
    return mysqli_num_rows($resultado) > 0; // Devuelve true si ya está guardada
}

function guardarNoticia($con, $id, $correo_electronico) {
    $sql = "INSERT INTO noticias_guardadas (ID_NOTICIAS, CORREO_ELECTRONICO) VALUES ($id, '" . mysqli_real_escape_string($con, $correo_electronico) . "')";
    mysqli_query($con, $sql);
}

function obtenerNoticiasGuardadas($con, $email_usuario) {
    // Consulta para obtener las noticias guardadas por el usuario
    $sql = "SELECT N.TITULO, N.ID_NOTICIAS, N.IMAGEN_N, N.FECHA_PUBLICACION FROM noticias N, noticias_guardadas NG WHERE N.ID_NOTICIAS = NG.ID_NOTICIAS 
            AND NG.CORREO_ELECTRONICO = '" . mysqli_real_escape_string($con, $email_usuario) . "'";
    $resultado = mysqli_query($con, $sql);
    // Recoger las noticias en un array
    $noticias_guardadas= [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $noticias_guardadas[] = $row;
    }
    return $noticias_guardadas; // Retornar las noticias guardadas
}
?>