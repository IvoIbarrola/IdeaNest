<?php 

$valideCode = $_POST['validateCode'];

include_once '../config/db_connection.php';

$sql = "SELECT * FROM users WHERE validate_code = '$valideCode'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    
    $sql = "UPDATE users SET state = 'validated' WHERE validate_code = '$valideCode'";
    
    if (mysqli_query($conn, $sql)) {
        ?>
        <script>
            alert("Usuario validado correctamente");
            window.location.href = "../public/views/login.php";
        </script>
        <?php
    } else {
        echo "Error al validar el usuario: " . mysqli_error($conn);
    }
} else {
    ?>
    <script>
        alert("El código de validación no es correcto");
        window.location.href = "../public/views/validate_code.php";
    </script>
    <?php
}

?>