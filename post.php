<?php
require("header.php");
require ("conexion.php");
require("./FUNCIONES/funcionsesion.php");
require("./FUNCIONES/funcionpost.php");

$post_id = $_GET['id'];

// Insertar nuevo comentario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario = $_POST['comentario'];
    $id_usuario = $_SESSION['ID_USUARIO'];
    
    // Llamar a la función para insertar el comentario
    insertarComentario($con, $post_id, $comentario, $id_usuario);
    
    // Refrescar la página para mostrar el nuevo comentario sin redirigir al foro
    header("Location: post.php?id=" . $post_id);
    exit();
}
// Obtener el post
$post = obtenerPost($con, $post_id);

// Verificar si el post existe
if (!$post) {
    die("El post no existe.");
}
// Obtener el nombre completo del usuario que publicó el post utilizando la nueva función
$post['NOMBRE_COMPLETO'] = obtenerNombreUsuario($con, $post['ID_USUARIO']);

// Obtener los comentarios
$comentarios = obtenerComentarios($con, $post_id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro - Discusión</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
</head>
<body class="body-post">
    <div class="containerpost">
        <!-- Caja de discusión -->
        <div class="discusion">
            <h1><?= htmlspecialchars($post['titulo']); ?></h1>
            <p><?= htmlspecialchars($post['contenido']); ?></p>
            <p>Publicado por <a href="perfilcomun.php?id=<?= $post['ID_USUARIO']; ?>"><?= htmlspecialchars($post['NOMBRE_COMPLETO']); ?></a> el <?= htmlspecialchars($post['fecha_post']); ?></p>
        </div>
        <!-- Contenedor para comentarios y el formulario -->
         <div class="formulariocomentario">
                <h2>Agregar Comentario</h2>
                <form method="POST" action="post.php?id=<?= $post_id; ?>">
                    <textarea name="comentario" required></textarea>
                    <input type="submit" value="Comentar">
                </form>
            </div>
        <div class="comentarios-y-formulario">
            <!-- Contenedor de comentarios -->
            <div class="comentarios-container">
                <h2>Comentarios</h2>
                <?php foreach ($comentarios as $comentario): ?>
                    <div class="comentario">
                        <p class="usuario">El usuario <a href="perfilcomun.php?id=<?= $comentario['ID_USUARIO']; ?>"><?=
                        htmlspecialchars($comentario['NOMBRE_COMPLETO']);?></a> dijo:</p>
                        <p><?= htmlspecialchars($comentario['comentario']);?></p>
                        <p>Subido el: <?= htmlspecialchars($comentario['fecha_comentario']);?></p>

                        <?php if ($comentario['ID_USUARIO'] == $_SESSION['ID_USUARIO']): ?>
            <!-- Botón de editar -->
            <a href="editar_comentario.php?id=<?= $comentario['ID_COMENTARIO']; ?>" class="boton-editar">
                <i class="fas fa-edit"></i> Editar
            </a>
                    <!-- Botón de borrar -->
                    <a href="borrar_comentario.php?id=<?= $comentario['ID_COMENTARIO']; ?>" class="boton-borrar" onclick="return confirm('¿Estás seguro de que deseas borrar este comentario?');">
                    <i class="fas fa-trash-alt"></i> Borrar</a><?php endif; ?> 
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <a href="foro1.php" class="volverforo">Volver al Foro</a>
    <?php require("footer.php"); ?>
</body>
</html>