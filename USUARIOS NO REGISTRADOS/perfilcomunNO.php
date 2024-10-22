<?php
require("headerNO.php");
require("../conexion.php");
require("../FUNCIONES/funcionperfil.php");


$con = conectar_bd();

// Verificar si se pasó el ID del usuario en la URL
if (isset($_GET['id'])) {
    $id_usuario = (int) $_GET['id']; // Obtener el ID del usuario de la URL y asegurarse de que es un número entero
} else {
    $id_usuario = verificarSesion(); // Si no hay ID en la URL, mostrar el perfil del usuario logueado
}
// Obtener los datos del perfil del usuario
$user = obtenerPerfilPorId($con, $id_usuario);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CROBIGOL</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    echo "<img src='data:image/jpeg;base64,$fotoBase64' alt='Foto de perfil' />"; 
                    ?>
                <?php else: ?>
                    <img src="../IMAGENES/perfildefault.jpg" alt="Foto de perfil" />
                <?php endif; ?>
            </div>
            <div class="datos">
                <p><strong>USUARIO:</strong> <?php echo htmlspecialchars($user['NOMBRE_COMPLETO']); ?></p>
                <p><strong>DESCRIPCIÓN:</strong> <?php echo htmlspecialchars($user['DESCRIPCION']); ?></p>
            </div>
        </div>
    </main>
    <?php require("../footer.php"); ?>
</body>
</html>

