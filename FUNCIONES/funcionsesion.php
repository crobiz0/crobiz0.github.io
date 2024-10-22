<?php
session_start();
function verificarSesion() { 
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
} else {
    $email = $_SESSION["email"];
}

return $_SESSION["email"]; // Devuelve el email del usuario
}
?>