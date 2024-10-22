<?php

require("error.php");
require("conexion.php");

$con = conectar_bd();

// Comprobar que se envió un formulario por POST desde carga_datos
if (isset($_POST["envio"])) {

    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $contrasenia = $_POST["pass"];

    // Validar que el email sea válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "¡No se puede insertar la información! Email inválido.";
        header("Refresh: 2; url=/register.php");
            exit();
    } else {
        // Consultar si el usuario ya existe
        $existe_usr = consultar_existe_usr($con, $email);

        // Insertar datos si el usuario no existe
        insertar_datos($con, $nombre, $email, $contrasenia, $existe_usr);
    }
}

function consultar_existe_usr($con, $email) {
    $email = mysqli_real_escape_string($con, $email); // Escapar los campos para evitar inyección SQL
    $consulta_existe_usr = "SELECT CORREO_ELECTRONICO FROM usuarios WHERE CORREO_ELECTRONICO = '$email'";
    $resultado_existe_usr = mysqli_query($con, $consulta_existe_usr);

    if (mysqli_num_rows($resultado_existe_usr) > 0) {
        return true;
    } else {
        return false;
    }
}

function insertar_datos($con, $nombre, $email, $contrasenia, $existe_usr) {
    if ($existe_usr == false) { //verifica si el ususario no existe
        $nombreCompleto = $nombre;
        $email = mysqli_real_escape_string($con, $email); 

        // Encripto la contraseña usando la función password_hash
        $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT); //se cifra contra de usuario

        $consulta_insertar = "INSERT INTO usuarios (NOMBRE_COMPLETO,CORREO_ELECTRONICO,CONTRASEÑA) VALUES ('$nombreCompleto', '$email', '$contrasenia')";

        if (mysqli_query($con, $consulta_insertar)) {
            echo '<div class="mensaje">¡Se insertaron los datos correctamente!</div>';
            // Redirigir a login.php después de 2 segundos
            header("Refresh: 2; url=/login.php");
            exit(); // Detener el script aquí
        } else {
            echo '<div class="mensaje"> ¡No se puede insertar la información! </div>'. "<br>";
            echo "Error: " . $consulta_insertar . "<br>" . mysqli_error($con);
        }
    } else {
        echo '<div class="mensaje">El usuario ya existe. </div>';
        header("Refresh: 2; url=/login.php");
        exit(); // Detener el script aquí
    }
}

mysqli_close($con);

?>
