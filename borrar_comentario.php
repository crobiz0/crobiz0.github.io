<?php
require("header.php");
require("conexion.php");
require("./FUNCIONES/funcionsesion.php");
require("./FUNCIONES/funcionpost.php");

$comentario_id = $_GET['id'];
$id_usuario = $_SESSION['ID_USUARIO']; 

// Verificar que el comentario pertenece al usuario actual
$comentario = obtenerComentarioPorId($con, $comentario_id, $id_usuario);

if (!$comentario) {
    die("No tienes permiso para eliminar este comentario.");
}

// Procesar la eliminación
if (borrarComentario($con, $comentario_id, $id_usuario)) {
    header("Location: post.php?id=" . $comentario['ID_POST']);
    exit();
} else {
    echo "Error al eliminar el comentario.";
}
?>
