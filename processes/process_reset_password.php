<?php
$id = $_GET['id'];
$new_password = $_POST['new_password'];

include_once '../config/db_connection.php';

$sql = "UPDATE users SET password = '$new_password' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    ?>
    <script>
        alert("Contraseña cambiada con éxito.");
        window.location.href = "../public/views/login.php";
    </script>
    <?php
} else {
    ?>
    <script>
        alert("Error al cambiar la contraseña.");
        window.location.href = "../public/views/reset_password.php?id=<?php echo $id; ?>";
    </script>
    <?php
}
mysqli_close($conn);
?>