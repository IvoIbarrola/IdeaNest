<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/public/css/styles.css">

    <title>IdeaNest | Recuperar Contraseña</title>
</head>
<body>
    <?php include 'sidebar.php' ?>

    <div class="login-container">
        <h1>Enviar Correo De Recuperación</h1>
        <form action="../../processes/process_recover_password.php" method="POST">
            <input value="" type="email" id="email" name="email" placeholder="Correo Electrónico" required>
            <input type="submit" value="Enviar Correo De Recuperación">
        </form>
    </div>
    
    <script src="/public/js/scripts.js"></script>
</body>
</html>