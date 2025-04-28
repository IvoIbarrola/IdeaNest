<?php
$email = $_POST['email'];

include_once '../config/db_connection.php';

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) <= 0) {
    ?>
    <script>
        alert("El correo electrónico no está registrado.");
        window.location.href = "../public/views/recover_password.php";
    </script>
    <?php
    exit;
} else {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];

    require_once 'process_sendMail.php';

    $config = '../config/config.php';
    $content = "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Recuperación de contraseña</title>
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
            <h1>Recuperación de contraseña</h1>
            <p>Hola, $username</p>
            <p>Para restablecer tu contraseña, haz clic en el siguiente enlace:</p>
            <p><a href='http://localhost:8080/public/views/reset_password.php?id=$id'>Restablecer contraseña</a></p>
            <p>Si no solicitaste este cambio, ignora este mensaje.</p>
            <p>Saludos,<br>El equipo de soporte</p>
        </div>
    </body>
    </html>
    // ";

    $fileConfig = fopen($config, 'r');

    $line = fgets($fileConfig);
    $fields = explode("|", $line);
    $emailFrom = $fields[0];
    $credential = $fields[1];

    sendMail($email, $content, "Recuperar contraseña", '', $emailFrom, $credential);
    fclose($fileConfig);

    ?>

    <script>
        alert("Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña.");
        //window.location.href = "../public/views/inicio.php";
        window.location.href = "../public/views/reset_password.php?id=<?php echo $id; ?>";
    </script>
    <?php
}
?>