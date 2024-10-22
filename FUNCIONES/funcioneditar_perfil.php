<?php

// Obtener los datos del usuario
function obtenerperfil($con, $email){

$sql = "SELECT NOMBRE_COMPLETO, FOTO_DE_PERFIL, DESCRIPCION FROM Usuarios WHERE CORREO_ELECTRONICO = '$email'"; 
$resultado = mysqli_query($con, $sql); //ejecuta la consulta
$user = mysqli_fetch_assoc($resultado); //verifica si la consulta devolvio una fila de resultados
return $user; // Retornar los datos del usuario
}
// Manejar el envío del formulario
function actualizarperfil($con, $email, $user) {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreCompleto = $_POST['nombre_completo'];
    $descripcion = $_POST['descripcion'];
    
    // Procesar la foto
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == UPLOAD_ERR_OK) {
        $fotoData = file_get_contents($_FILES['foto_perfil']['tmp_name']);
    } else {
        $fotoData = $user['FOTO_DE_PERFIL']; // Mantener la foto actual si no se carga una nueva
    }
  // Actualizar los datos del usuario
$sql = "UPDATE Usuarios SET NOMBRE_COMPLETO = '$nombreCompleto', DESCRIPCION = '$descripcion', FOTO_DE_PERFIL = '" . mysqli_real_escape_string($con, $fotoData) . "' WHERE CORREO_ELECTRONICO = '$email'";
if (mysqli_query($con, $sql)) {
    header("Location: perfil.php");
    exit();
} else {
    echo "Error al actualizar el perfil: " . mysqli_error($con);
}   
mysqli_close($con);
}
}

?>