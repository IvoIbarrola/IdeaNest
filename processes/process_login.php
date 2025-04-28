<?php
session_start();

$email = trim($_POST['email']);
$password = trim($_POST['password']);

echo $email . "<br>";
echo $password . "<br><br>";

include '../config/db_connection.php';

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND state = 'validated'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $_SESSION['login'] = true;
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['username'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['password'] = $row['password'];

    ?>
    <script>
        alert("Bienvenido, <?php echo $_SESSION['user_name']; ?>");
        window.location.href = "/public/views/inicio.php";
    </script>
    <?php
} else {
    ?>
    <script>
        alert("Error: Correo o contraseña incorrectos o cuenta no validada.");
        window.location.href = "/public/views/login.php";
    </script>
    <?php
}

$conn->close();

?>