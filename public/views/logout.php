<?php session_start(); ?>
<script>
    if(confirm("¿Estás seguro de que deseas cerrar sesión?")) {
        <?php session_destroy(); ?>
        alert("Has cerrado sesión correctamente.");
        window.location.href = "/public/views/login.php";
    }
    if(!confirm("¿Estás seguro de que deseas cerrar sesión?")) {
        window.location.href = "/public/views/inicio.php";
    }
</script>
