<?php
require_once 'phpMail/class.phpmailer.php'; // Incluye la clase PHPMailer para manejar el envío de correos.
require_once 'phpMail/class.smtp.php'; // Incluye la clase SMTP para manejar la conexión SMTP.

function sendMail($to, $mailBody = '', $mailSubject = '', $attachment = '', $from, $credential) 
{
    // Si no se proporciona un cuerpo para el correo, se asigna un mensaje predeterminado.
    if ($mailBody == '') { 
        $mailBody = 'No details were provided in the email body'; 
    }
    // Si no se proporciona un asunto para el correo, se asigna un asunto predeterminado.
    if ($mailSubject == '') { 
        $mailSubject = 'New event notification';
    }
    
    $bccRecipient = ''; // Variable para almacenar destinatarios en copia oculta (BCC).

    $mail = new PHPMailer(); // Crea una nueva instancia de PHPMailer.

    $mail->isSMTP(); // Configura el uso de SMTP.
    $mail->SMTPAuth = true; // Habilita la autenticación SMTP.
    $mail->SMTPSecure = "tls"; // Configura el protocolo de seguridad TLS.
    $mail->Host = "smtp.gmail.com"; // Configura el servidor SMTP (en este caso, Gmail).
    $mail->Port = 587; // Configura el puerto SMTP.
    $mail->Username = $from; // Configura el nombre de usuario para la autenticación SMTP.
    $mail->Password = $credential; // Configura la contraseña para la autenticación SMTP.
    $mail->CharSet = 'UTF-8'; // Configura el conjunto de caracteres para el correo.

    // Valida que el correo del remitente sea válido.
    if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
        return "Error: The sender's email is not valid.";
    }
    // Verifica que las credenciales SMTP no estén vacías.
    if (empty($credential)) {
        return "Error: The SMTP credential cannot be empty.";
    }

    // Configura el remitente del correo.
    $mail->setFrom("noresponder@miplataforma.com", "User Registration");
    // Configura la dirección de respuesta.
    $mail->addReplyTo("soporteusuarios@miplataforma.com", "User Registration Complaint");
    // Agrega el destinatario principal.
    $mail->addAddress($to);
    // Agrega un destinatario en copia oculta (BCC).
    $mail->addBCC($bccRecipient);
    // Configura el asunto del correo.
    $mail->Subject = $mailSubject;

    // Configura el cuerpo del correo en formato HTML.
    $mail->msgHTML($mailBody);

    // Si se proporciona un archivo adjunto, lo agrega al correo.
    if ($attachment != '') { 
        $mail->addAttachment($attachment);
    }

    $mail->isHTML(true); // Indica que el correo está en formato HTML.

    // Intenta enviar el correo y devuelve el resultado.
    if ($mail->send()) { 
        //echo "The email has been successfully sent"; // Mensaje de éxito.
        $result = true;
    } else { 
        $result = "Error in sending: " . $mail->ErrorInfo; // Mensaje de error con detalles.
    }
    return $result; // Devuelve el resultado del envío.
}
?>

