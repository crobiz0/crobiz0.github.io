<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<center>
<h1>SUBIR NOTICIA</h1>

<form id="formnoticia" name="form1" method="post" enctype="multipart/form-data" action="subir_noticia.php">
    <label for="tnoticia">Titulo de la Noticia:</label>
    <input type="text" name="titulo" id="tnoticia" required>

    <label for="noticia">Contenido</label>
    <textarea name="contenido" id="contenido" rows="5" cols="50" required></textarea>

    <label for="imagen">Imagen</label>
    <input type="file" name="imagen" id="imagen" required>

    <input type="submit" value="Subir Noticia" name="envio">
    <input type="reset" value="Cancelar">
</form>
</center>
<a href="admin.php" class="button-link">Volver Pagina Admin</a>
</body>