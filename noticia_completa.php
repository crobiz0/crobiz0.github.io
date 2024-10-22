<?php
require("header.php");
require("conexion.php");
require("./FUNCIONES/funcionsesion.php");
require("./FUNCIONES/funcionNoticiacompleta.php");

$email_usuario = verificarSesion();

if (isset($_GET['id'])) { //comprueba si hay una id
    $id = $_GET['id'];

$haVotado = verificarVoto($con, $id, $email_usuario); // Verifica si el usuario ya ha votado en esta noticia
$haGuardado = verificarGuardado($con, $id, $email_usuario); // Verifica si el usuario ya ha guardado esta noticia

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verifica si el formulario ha sido enviado
        if (isset($_POST['guardar']) && !$haGuardado) {
            guardarNoticia($con, $id, $email_usuario);
            header("Location: noticia_completa.php?id=" . $id);
            exit();
        }
    if (isset($_POST['like'])) {     // Si el botón de like fue presionado...
        actualizarLikes($con, $id);
        registrarVoto($con, $id, $email_usuario, 'like');
    } elseif (isset($_POST['dislike'])) {  // Si el botón de dislike fue presionado...
        actualizarDislikes($con, $id);
        registrarVoto($con, $id, $email_usuario, 'dislike');
    }

header("Location: noticia_completa.php?id=" . $id);
exit();
}
$row = obtenerNoticia($con, $id);
} else {
die("ID de noticia no especificado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['TITULO']); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/kMVqGp4pCgxK+gUVw5fQ4pUxxXk6i4v9e4+Q5/T5f69BLin5o1M0yQZV9Z+IWkj3G0Db/ej4jPzAA==">
</head>
<body>
    <main>
        <h1 class="TITULO"><?php echo htmlspecialchars($row['TITULO']); ?></h1>
        <div class="noticia-completa">
            <div class="IMAGEN_N">
            <?php
            $imagenData = $row['IMAGEN_N'];
            $imagenBase64 = base64_encode($imagenData);
            echo "<img src='data:image/jpeg;base64," . $imagenBase64 . "' alt='Imagen de noticia'/>";
            ?>
            </div>
            <div class="bloque-contenido">
            <p><?php echo htmlspecialchars($row['CONTENIDO']); ?></p></div>
            <p>Publicado el: <?php echo htmlspecialchars($row['FECHA_PUBLICACION']); ?></p>

            <p>Likes: <?php echo $row['LIKES']; ?> | Dislikes: <?php echo $row['DISLIKES']; ?></p>
            
            <?php if (!$haVotado): ?>
            <form method="POST" action="" class="likes">
    <button type="submit" name="like" class="like">Me gusta</button>
    <button type="submit" name="dislike" class="dislike">No me gusta</button>
</form>



<?php else: ?>
<p>Ya has votado en esta noticia.</p>
<?php endif; ?>
 <!-- Botón de Guardar -->
 <?php if (!$haGuardado): ?>
            <form method="POST" action="">
                <button type="submit" name="guardar" class="guardar">
                    <i class="fas fa-bookmark"></i> Guardar
                </button>
            </form>
            <?php else: ?>
            <p>Ya has guardado esta noticia.</p>
            <?php endif; ?>
</div>
</main>
<?php require("footer.php"); ?>
</body>
</html>
