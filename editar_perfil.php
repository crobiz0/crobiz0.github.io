<?php
require("header.php");
require("conexion.php");
require("./FUNCIONES/funcionsesion.php");
require ("./FUNCIONES/funcioneditar_perfil.php");

// Crear la conexión a la base de datos
$con = conectar_bd();

// Verificar la sesión y obtener el email del usuario
$email = verificarSesion(); // Usamos la función para obtener el email

// Obtener los datos del perfil del usuario
$user = obtenerperfil($con, $email);

// Manejar la actualización del perfil si se ha enviado el formulario
actualizarperfil($con, $email, $user);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="editar_perfil">
    <main>
    <center><h1>Editar Perfil</h1></center>
        <center><form action="editar_perfil.php" method="post" enctype="multipart/form-data" class="e_perfil">
            <label for="nombre_completo">Nombre Completo:</label>
            <input type="text" id="nombre_completo" name="nombre_completo" value="<?php echo htmlspecialchars($user['NOMBRE_COMPLETO']); ?>" required>

            
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" maxlength="200" rows="4"><?php echo htmlspecialchars($user['DESCRIPCION']); ?></textarea>
            <div id="contador" style="color:white">Quedan <span id="caracteresRestantes">200</span> caracteres.</div>
                
            <label for="foto_perfil">Foto de Perfil:</label>
            <input type="file" id="foto_perfil" name="foto_perfil" style="color:white">

            <button type="submit">Actualizar Perfil</button>
        </form></center>
    </main>
</div>
<script src="contarcaracteres.js"></script>

</body>
</html>