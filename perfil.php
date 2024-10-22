<?php
require("header.php");
require("conexion.php");
require("./FUNCIONES/funcionsesion.php");
require("./FUNCIONES/funcionperfil.php");
require("./FUNCIONES/funcionNoticiacompleta.php");

$con = conectar_bd();
// Verificar la sesión y obtener el email del usuario
$email = verificarSesion(); // Usamos la función para obtener el email
// Obtener los datos del perfil del usuario
$user = obtenerperfil($con, $email);
// Obtener noticias guardadas por el usuario
$noticiasGuardadas = obtenerNoticiasGuardadas($con, $email);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CROBIGOL</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="perfil">
    <main>
        <h1 class="perfil1" style="text-align: center; color: white;">PERFIL</h1>
        <div class="perfil-info">
            <div class="foto">
                <?php if (!empty($user['FOTO_DE_PERFIL'])): ?>
                    <?php
                    $fotoBase64 = base64_encode($user['FOTO_DE_PERFIL']); // base64_encode  Convierte esos datos binarios en una cadena de texto codificada en Base64.
                    echo "<img src='data:image/jpeg;base64,$fotoBase64' alt='Foto de perfil' />"; ?>
                <?php else: ?>
                    <img src="./IMAGENES/perfildefault.jpg" alt="Foto de perfil" />
                <?php endif; ?>
            </div>
            <div class="datos">
                <p><strong>USUARIO:</strong> <?php echo htmlspecialchars($user['NOMBRE_COMPLETO']); ?></p>
                <p><strong>DESCRIPCIÓN:</strong> <?php echo htmlspecialchars($user['DESCRIPCION']); ?></p>
                <a href="editar_perfil.php" class="editar-btn">Editar Perfil</a>
            </div>
        </div>
         <!-- Sección de Noticias Guardadas -->
         <h2 style="color: #ffffff; text-align: center;">Noticias Guardadas</h2>
        <section class="noticias" id="resultados">
        <?php if (!empty($noticiasGuardadas)): ?>
            <?php foreach ($noticiasGuardadas as $noticia): ?>
                <div class="noticia" id="resultados">
                    <div class="imagen-noticia">
                        <?php
                        // Aquí puedes agregar lógica para obtener la imagen de la noticia si es necesario
                        $imagenData = $noticia['IMAGEN_N'];
                        if (!empty($imagenData)) {
                            $imagenBase64 = base64_encode($imagenData);
                            echo "<img src='data:image/jpeg;base64,$imagenBase64' alt='Imagen de noticia' />";
                        }
                        ?>
                    </div>
                    <p><?php echo htmlspecialchars($noticia['TITULO']); ?></p>
                    <p>Subido el: <?php echo htmlspecialchars($noticia['FECHA_PUBLICACION']); ?></p>
                    <a href="noticia_completa.php?id=<?php echo $noticia['ID_NOTICIAS']; ?>" class="leer_mas">Leer Más</a>
                 <!-- Icono para quitar noticia guardada -->
                 <a href="quitar_noticiaguardada.php?id=<?php echo $noticia['ID_NOTICIAS']; ?>" class="quitar-guardado"  title="Quitar Noticia">
                        <i class="fas fa-trash" style="color: red;"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No has guardado ninguna noticia.</p>
        <?php endif; ?>
        </section>
    </main>
    <?php require("footer.php"); ?>

</body>
</html>