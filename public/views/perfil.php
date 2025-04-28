<?php 
    session_start(); 

    if (!isset($_SESSION['login'])) {
        header('Location: login.php');
        exit();
    }
?>
<script>
    var verificationPasswor = prompt("Ingrese su contraseña por favor");

    if (verificationPasswor != "<?php echo $_SESSION['password']; ?>") {
        alert("Contraseña incorrecta");
        window.history.back();
    }
</script>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="/public/css/styles.css">
    
    <title>IdeaNest | Mi Perfil</title>

    <style>
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .toggle-icon {
            position: absolute;
            right: 10px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-icon svg {
            width: 24px;
            height: 24px;
            transition: opacity 0.3s ease;
        }
    </style>
</head>
<body>
    
    <?php include 'sidebar.php'; ?>

    <div class="login-container">
        <h1>Mi Perfil</h1>
        <form action="../../processes/process_update_data.php" method="POST">
            <input type="text" id="nombre" name="username" placeholder="Nombre De Usuario" value="<?php echo $_SESSION['user_name']; ?>" required>
            <input type="email" id="email" name="email" placeholder="Correo Electrónico" value="<?php echo $_SESSION['email']; ?>" required>

            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Contraseña" value="<?php echo $_SESSION['password']; ?>" required>
                <button type="button" class="toggle-icon" onclick="togglePassword()" id="toggleButton">
                    <!-- Ícono de ojo abierto -->
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <!-- Ícono de ojo cerrado -->
                    <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none;">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.045-3.527M9.88 9.88a3 3 0 104.243 4.243M6.1 6.1l11.8 11.8"/>
                    </svg>
                </button>
            </div>

            <input type="submit" value="Actualizar Datos">
        </form>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');
            
            const isPassword = passwordInput.getAttribute('type') === 'password';

            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            eyeOpen.style.display = isPassword ? 'none' : 'inline';
            eyeClosed.style.display = isPassword ? 'inline' : 'none';
        }
    </script>
    
    <script src="../js/scripts.js"></script>

</body>
</html>
