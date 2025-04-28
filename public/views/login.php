<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/public/css/styles.css">

    <title>IdeaNest | Iniciar Sesión</title>
</head>
<body>
    <?php include 'sidebar.php' ?>

    <div class="login-container">
        <h1>Iniciar Sesión</h1>
        <form action="../../processes/process_login.php" method="POST">
            <input value="" type="email" id="email" name="email" placeholder="Correo Electrónico" required>
            <input value="" type="password" id="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="Ingresar">
        </form>
        <a href="register.php">¿No tienes una cuenta? Regístrate</a>
        <a href="validate_code.php">¿Olvidaste validar tu cuenta?</a>
        <a href="recover_password.php">¿Olvidaste tu contraseña?</a>
    </div>
    
    <script src="/public/js/scripts.js"></script>
</body>
</html>