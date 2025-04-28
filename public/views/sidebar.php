<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
    <a href="inicio.php">Inicio</a>
    <?php if (isset($_SESSION['login'])): ?>
        <a href="mis_ideas.php">Mis Ideas</a>
        <a href="perfil.php">Mi Perfil</a>
        <a href="logout.php">Cerrar Sesión</a>
    <?php else: ?>
        <a href="login.php">Iniciar Sesión</a>
        <a href="register.php">Registrarse</a>
    <?php endif; ?>
    <a href="acercaDe.php">Acerca de IdeaNest</a>
</div>
<div id="main">
    <button id="menuButton" style="font-size:20px;cursor:pointer;background-color:#fff;color:#333;border:1px solid #ccc;;padding:10px 15px;border-radius:5px;" onclick="openNav()">&#9776;</button>
</div>
