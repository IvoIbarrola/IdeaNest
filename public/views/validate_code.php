<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/public/css/styles.css">

    <title>IdeaNest | Validar Codigo</title>
</head>
<body>
    <?php include 'sidebar.php' ?>

    <div class="login-container">
        <h1>Validar Codigo</h1>
        <form action="../../processes/process_validate_code.php" method="POST">
            <input value="" type="text" id="" name="validateCode" placeholder="Codigo De Validación" required>
            <input type="submit" value="Validar">
            <a href="">Reenviar codigo</a>
        </form>
    </div>
    
    <script src="/public/js/scripts.js"></script>
</body>
</html>