<?php
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$validationCode = rand(1000, 9999);

include_once '../config/db_connection.php';

$sql = "INSERT INTO users (username, email, password, validate_code) VALUES ('$username', '$email', '$password', '$validationCode')";
$result = mysqli_query($conn, $sql);

if ($result) {
    ?> <script> 
            alert("Registro exitoso");
            window.location.href = "../public/views/validate_code.php"; 
    </script> <?php
} else {
    ?> <script> 
            alert("Nombre de usuario o correo electrónico ya existe");
            window.location.href = "../public/views/register.php"; 
    </script> <?php
}
$conn->close();

require_once('process_sendMail.php');

$config = '../config/config.php';
$content = "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Verificación de cuenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Verificación de cuenta</h1>
        <p>Hola, $username</p>
        <p>Gracias por registrarte. Tu código de verificación es: <strong>$validationCode</strong></p>
        <p>Por favor, ingresa este código en la página de verificación.</p>
        <p>Saludos,<br>El equipo de soporte</p>
    </div>
</body>
</html>
";

$fileConfig = fopen($config, 'r');

$line = fgets($fileConfig);
$fields = explode("|", $line);
$emailFrom = $fields[0];
$credential = $fields[1];

sendMail($email, $content, "Código de verificación", '', $emailFrom, $credential);
fclose($fileConfig);

?>