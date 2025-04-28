<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/public/css/styles.css">

    <title>IdeaNest | Crear Cuenta</title>
</head>
<body>
    <?php include 'sidebar.php' ?>

    <div class="login-container">
        <h1>Crear Cuenta</h1>
        <form action="../../processes/process_register.php" method="POST">
            <input value="" type="text" id="email" name="username" placeholder="Nombre De Ususario" required>
            <input value="" type="email" id="email" name="email" placeholder="Correo Electrónico" required>
            <input value="" type="password" id="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="Ingresar">
        </form>
        <a href="login.php">¿ya tienes una cuenta? Iniciar Sesión</a>
    </div>
    
    <script src="/public/js/scripts.js"></script>
</body>
</html>