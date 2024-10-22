<?php 
require("error.php");
require("conexion.php");

$con= conectar_bd();

if (isset($_POST["envio"])) { //se verifica si se recibio el formulario

    $email = $_POST["email"];
    $contrasenia = $_POST["pass"];

    // Llamada funcion login
    logear($con, $email, $contrasenia);
}
function logear($con, $email, $pass) {
    session_start();
    $consulta_login = "SELECT * FROM usuarios WHERE CORREO_ELECTRONICO= '$email'";
    $resultado_login = mysqli_query($con, $consulta_login); //ejecuta la consulta y la guardaen $resultado_login

    if (mysqli_num_rows($resultado_login) > 0) { //verifica si la consulta devolvió alguna fila

        //se crea una variable con el objeto fetch asoc para acceder a las columnas que necesite
        $fila = mysqli_fetch_assoc($resultado_login);

        //asigno en una variable el campo pass de la BD...
        $password_bd = $fila["CONTRASEÑA"];

        //uso la funcion password_verify para comparar lo que ingresa el usuario con lo que tengo en la BD.
        if (password_verify($pass, $password_bd)) {
            
             // Verificar si el usuario está bloqueado
    if ($fila["ESTA_BLOQUEADO"] == 1) {
        echo "Este usuario está bloqueado y no puede iniciar sesión.";
        header("Refresh: 3; url=/login.php");  // Redirige de vuelta al login después de 3 segundos
        exit();
    }
            //si todo es correcto inicio la sesion y redirijo a la pagina del usuario logueado
            $emailadmin = "inettinahuel@gmail.com";
            $_SESSION["email"] = $email;
            $_SESSION["ID_USUARIO"] = $fila["ID_USUARIO"]; // Guarda el ID del usuario en la sesión
            $esAdmin = ($email === $emailadmin);

            if ($esAdmin) {

                header("Location: admin.php");
            } else{
            header("Location: principal.php");
            }
            exit();
            } else {
                echo "Contraseña incorrecta";
                header("Refresh: 2; url=/login.php");
                exit(); 
            }
        } else {
            echo "El usuario no existe";
            header("Refresh: 2; url=/login.php");
            exit();
        }
    }
    ?>