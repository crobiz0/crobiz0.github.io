<?php
require("headerNO.php");
require("../conexion.php");
require("../FUNCIONES/funcionNoticiacompleta.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
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
    <link rel="stylesheet" href="../style.css">
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
            echo "<img src='data:image/jpeg;base64," . $imagenBase64 . "' alt='Imagen de noticia' />";
            ?>
            </div>
            <div class="bloque-contenido">

            <p><?php echo htmlspecialchars($row['CONTENIDO']); ?></p></div>
            <p>Publicado el: <?php echo htmlspecialchars($row['FECHA_PUBLICACION']); ?></p>
    </div>
    </main>
</body>
</html>
<?php require("../footer.php"); ?>