<?php
require("headerNO.php");
require("../conexion.php");
require("../FUNCIONES/funcionforo.php");

$con = conectar_bd();

// Capturar el término de búsqueda si se envió
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';


// Si hay búsqueda, obtener posts por título, si no, obtener todos los posts
if (!empty($buscar)) {
    $posts = obtenerpostportitulo($con, $buscar);
} else {
    $posts = obtenerTodosLosPosts($con);
}
// Verificar si la consulta fue exitosa
if (!$posts) {
    die("Error en la consulta de posts: " . mysqli_error($con));
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../styleforo.css">
    <script src="../buscador_foro.js"></script>
</head>
<body>
<div class="containerforos">
    <h1>Foro</h1>
    <center>
        <form action="foroNO.php" method="GET" class="" onsubmit="buscarPosts(); return false;">
            <input type="text" id="buscar" name="buscar" class="" placeholder="Buscar posteos por título..." onkeyup="buscarPosts()" />
        </form>
    </center>
    <center><h2 style="color:white">¡Registrate para poder crear un post!</h2></center>
    <div class="discusiones-container" id="resultados">
        <?php foreach ($posts as $post): ?>
            <?php
            // Obtener el nombre del usuario basado en el ID_USUARIO usando una función
            $usuario_nombre = obtenerNombreUsuarioForo($con, $post['ID_USUARIO']);
  // Verificar si la consulta del usuario fue exitosa
  if (!$usuario_nombre) {
    die("Error en la consulta de usuario: " . mysqli_error($con));
}
            ?>
            <div class="discusion">
                <h2><a href="postNO.php?id=<?= $post['ID_POST']; ?>"><?= htmlspecialchars($post['titulo']); ?></a></h2>
                <p>Publicado por <a href="perfilcomunNO.php?id=<?= $post['ID_USUARIO']; ?>"><?= htmlspecialchars($post['NOMBRE_COMPLETO']); ?></a></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require("../footer.php"); ?>
</body>
</html>