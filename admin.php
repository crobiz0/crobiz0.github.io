<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Panel de Administración</h1>
    <div class="admin-links">
        <a href="adminnoticia.php">Subir Noticias</a>
        <a href="adminfichajes.php">Subir Fichajes</a>
        <a href="admin_partidos.php">Subir Partidos</a>
        <a href="admin_partidos_finalizados.php">Subir Partido Finalizado</a>
        <a href="admin_tablaclasificacion.php">Actualizar Tabla de Clasificación</a>
    </div>
<br>
<center>
<form id="form-buscar-usuario" action="buscar_usuario.php" method="post">
    <label for="usuario">
        Buscar usuario:
        <input type="text" name="usuario" id="usuario" placeholder="Ingrese el nombre a buscar" required>
        <input type="submit" value="Buscar" name="envio">
        <input type="reset" value="Cancelar">
    </label>
</form>
</center>
<div id="resultado"></div>
<script src="app2.js"></script>
</main>
<a href="logout.php" id="cerrar_sesionn" style="font-size:30px;" class="button-link">Cerrar sesión</a>
</body>
</html>