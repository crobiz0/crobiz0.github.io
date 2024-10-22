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
<body class="login">
    <form action="logeado.php" method="POST">

    <img src="./IMAGENES/logo1.png" alt="Logo"> 
        <h2>CROBIGOL</h2>
        <h3>INICIAR SESIÓN</h3>
    <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Ingresa tu email" required>
    <label for="pass">Contraseña</label>
        <input type="password" name="pass" id="pass" placeholder="Ingresa tu contraseña" required  minlength="8">
        <a href="register.php" id="logueado?">¿No estas Logueado?</a>
        
    <input type="submit" value="Ingresar" name="envio">
    <input type="reset" value="Cancelar">
    </form>

    <script src="app.js"></script>
<script src="app2.js"></script>


</body>
</html>