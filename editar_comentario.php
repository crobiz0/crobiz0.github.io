<?php
require("header.php");
require("conexion.php");
require("./FUNCIONES/funcionsesion.php");
require("./FUNCIONES/funcionpost.php");

$comentario_id = $_GET['id'];
$id_usuario = $_SESSION['ID_USUARIO']; 

// Obtener el comentario por ID y asegurarse de que pertenece al usuario actual
$comentario = obtenerComentarioPorId($con, $comentario_id, $id_usuario);

if (!$comentario) {
    die("No tienes permiso para editar este comentario.");
}

// Procesar el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevo_comentario = $_POST['comentario'];
    
    if (editarComentario($con, $comentario_id, $nuevo_comentario, $id_usuario)) {
        header("Location: post.php?id=" . $comentario['ID_POST']);
        exit();
    } else {
        echo "Error al editar el comentario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Comentario</title>
</head>
<body class="body-post"> 
    <div class="container-crearpost">
        <h1 class="titulo-formulario">Editar Comentario</h1>
        <form method="POST" class="formulario-post">
            <label for="comentario" class="titulo-campo">Comentario:</label>
            <textarea name="comentario" id="comentario" class="input-contenido" required><?= htmlspecialchars($comentario['comentario']); ?></textarea>
            <input type="submit" value="Actualizar" class="boton-publicar">
        </form>
        <a href="post.php?id=<?= $comentario['ID_POST']; ?>" class="volver-foro">Volver a la discusión</a>
    </div>
</body>
</html>