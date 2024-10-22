<?php
require("header.php");
require("conexion.php");
require("./FUNCIONES/funcionsesion.php");
require("./FUNCIONES/funcionposteos.php");
$con = conectar_bd();

if (!isset($_SESSION['ID_USUARIO'])) {
    die('Debes iniciar sesión para crear un post.');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $id_usuario = $_SESSION['ID_USUARIO'];

    // Usar la función para crear el post
    $error_message = crearPost($con, $titulo, $contenido, $id_usuario);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-crearpost">
        <center>
            <h1 class="titulo-formulario">Crear Nueva Discusión</h1>
            <form method="POST" action="crear_post.php" class="formulario-post">
                <h2 class="titulo-campo">Título: 
                    <input type="text" name="titulo" class="input-titulo" required>
                </h2>
                <h2 class="contenido-campo">Contenido: 
                    <textarea name="contenido" class="input-contenido" required></textarea>
                </h2>
                <input type="submit" value="Publicar" class="boton-publicar">
                <?php if (isset($error_message) && $error_message): ?>
                    <p class="error-message" style="color:red"><?= $error_message ?></p>
                <?php endif; ?>
            </form>
            <a href="foro1.php" class="volver-foro">Volver al Foro</a>
        </center>
    </div>
</body>
</html>