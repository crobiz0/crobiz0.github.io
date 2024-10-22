<?php 
   // Función para verificar si los campos del post están vacíos
function validarCamposPost($titulo, $contenido) {
    if (empty($titulo) || empty($contenido)) {
        return 'Por favor, rellena todos los campos.';
    }
    return '';
}

// Función para insertar el post en la base de datos
function insertarPost($con, $titulo, $contenido, $id_usuario) {
    // Consulta SQL para insertar el post
    $sql = "INSERT INTO post (titulo, contenido, ID_USUARIO) VALUES ('$titulo', '$contenido', '$id_usuario')";
    
    // Ejecutar la consulta
    if (mysqli_query($con, $sql)) {
        return true; // Post insertado con éxito
    } else {
        return 'Error al crear la publicación: ' . mysqli_error($con);
    }
}


// Función para manejar la lógica de creación de post
function crearPost($con, $titulo, $contenido, $id_usuario) {
    // Validar los campos del formulario
    $error_message = validarCamposPost($titulo, $contenido);
    
    // Si hay error, devolver el mensaje de error
    if ($error_message) {
        return $error_message;
    }

    // Intentar insertar el post en la base de datos
    $resultado = insertarPost($con, $titulo, $contenido, $id_usuario);
    
    // Verificar si hubo error al insertar el post
    if ($resultado === true) {
        header("Location: foro1.php"); // Redirigir si todo fue bien
        exit();
    } else {
        return $resultado; // Devolver el mensaje de error en caso de fallo
    }
}
