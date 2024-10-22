<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>
<body class="register">

<form action="registrado.php" method="POST" class="formulario">

<img src="/IMAGENES/logo1.png" alt="Logo"> 
        <h2>CROBIGOL</h2>
        <h3>Registrarse</h3>

<label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" placeholder="Ingresa tu nombre" maxlength="15">

<label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="Ingresa tu email">

<label for="pass">Contraseña</label>
    <input type="password" name="pass" id="pass" placeholder="Ingresa tu contraseña"  minlength="8">

    <a href="login.php" id="registrado?">¿Ya estas registrado?</a>

<input type="submit" value="Registrarse" name="envio">
<input type="reset" value="Cancelar">


<script src="app.js"></script>
<script src="app2.js"></script>

</form>