<?php

// Obtener los datos del usuario
function obtenerperfil($con, $email) {
    $email = mysqli_real_escape_string($con, $email);
    
$sql = "SELECT NOMBRE_COMPLETO, FOTO_DE_PERFIL, DESCRIPCION FROM Usuarios WHERE CORREO_ELECTRONICO = '$email'";
$resultado = mysqli_query($con, query: $sql);
$user = mysqli_fetch_assoc($resultado);


return $user;
mysqli_close($con);
}

// Obtener los datos del usuario por ID
function obtenerPerfilPorId($con, $id_usuario) {
    $id_usuario = (int) $id_usuario; // Sanitiza el ID para evitar inyecciones SQL
    $sql = "SELECT NOMBRE_COMPLETO, FOTO_DE_PERFIL, DESCRIPCION FROM Usuarios WHERE ID_USUARIO = $id_usuario";
    $resultado = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($resultado);

    return $user;
}
?>
