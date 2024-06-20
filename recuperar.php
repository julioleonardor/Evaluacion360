<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'public/PHPMailer/src/Exception.php';
require 'public/PHPMailer/src/PHPMailer.php';
require 'public/PHPMailer/src/SMTP.php';
include("config/conexion.php");

$email_user = $_POST['email_user2'];

$sql = mysqli_query($conn, "SELECT * FROM usuario WHERE email_user = '$email_user'");
$nr = mysqli_num_rows($sql);

if ($nr == 1) {
    $mostrar = mysqli_fetch_array($sql);
    $enviarpass = $mostrar['pass_user'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com.';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';
        $mail->Username = 'correo@correo.com';
        $mail->Password = 'contraseña';
        $mail->setFrom('correo@correo.com', 'Evaluación 360');
        $mail->addAddress($email_user);
        $mail->isHTML(true);
        $mail->Subject = 'Recuperar contraseña';
        $mail->Body = "Hola {$mostrar['name_user']},<br><br>
                        Hemos recibido una solicitud para recuperar la contraseña de tu cuenta. 
                        Tu contraseña es: <strong>{$enviarpass}</strong><br><br>
                        Por favor, inicia sesión con tu contraseña y cámbiala en tu perfil.<br><br>
                        Saludos,<br>
                        ";

        $mail->send();
        echo "<script> alert('Contraseña enviada por correo');window.location= 'index.php' </script>";
    } catch (Exception $e) {
        echo "<script> alert('Error: " . $mail->ErrorInfo . "');window.location= 'index.php' </script>";
    }
} else {
    echo "<script> alert('Este correo no existe');window.location= 'index.php' </script>";
}
?>

