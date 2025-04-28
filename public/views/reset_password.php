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
        <h1>Cambiar Contraseña</h1>
        <form action="../../processes/process_reset_password.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <input value="" type="password" id="new_password" name="new_password" placeholder="Nueva Contraseña" required>

            <input type="submit" value="cambiar contraseña">
        </form>
    </div>
    
    <script src="/public/js/scripts.js"></script>
</body>
</html>