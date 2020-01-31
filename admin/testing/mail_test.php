<?php

$mail_smtp=$GLOBALS['mail_smtp'];
$mail_port=$GLOBALS['mail_port'];
$mail_username=$GLOBALS['mail_username'];
$mail_password=$GLOBALS['mail_password'];
$debug_Status=$GLOBALS['debug_Status'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../includes/PHPMailer/src/PHPMailer.php';
include '../includes/PHPMailer/src/SMTP.php';
include '../includes/PHPMailer/src/POP3.php';
include '../includes/PHPMailer/src/Exception.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(false);

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

try {
    //Server settings
    if ($mail_port == '465' || $mail_port == '587'){
        if ($debug_Status == '1')
            $mail->SMTPDebug = true;                      // Enable verbose debug output
        else
            $mail->SMTPDebug = false;                      // Enable verbose debug output
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $mail_username;                     // SMTP username
        $mail->Password   = $mail_password;                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Host = 'ssl://' . $mail_smtp . ':' . $mail_port;
    }else{
        if ($debug_Status == '1')
            $mail->SMTPDebug = true;                      // Enable verbose debug output
        else
            $mail->SMTPDebug = false;                      // Enable verbose debug output
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = $mail_smtp;                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $mail_username;                     // SMTP username
        $mail->Password   = $mail_password;                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = $mail_port;                                    // TCP port to connect to
    }

    //$mail->Host = 'ssl://smtp.126.com:465';

    // To load the French version
    //$mail->setLanguage('../includes/PHPMailer/language/phpmailer.lang-ch.php');
    $mail->CharSet = "UTF-8";

    //Recipients
    $mail->setFrom($mail_username, 'Admin');
    $mail->addAddress('544901005@qq.com', 'User');     // Add a recipient
    $mail->addAddress('owen000814@outlook.com');               // Name is optional
    //mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('../assets/imgs/logo.png', 'logo.png');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = '[BETA系统]MEternity.cn';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b><b>发自管理员</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    if ($mail->ErrorInfo == '')
        $mail->ErrorInfo = 'null';
    echo "<script language=\"JavaScript\">\r\n";
    echo " alert(\"Message has been sent. Mailer Error: {$mail->ErrorInfo}\");\r\n";
    echo " window.location.href='setting_mail.php'\r\n";
    echo "</script>";
    exit;
    //echo '<script>SendSuccessMessage();</script>';
    //echo 'Message has been sent';
    //echo "<script>window.location.href='./setting_mail.php'</script>";
} catch (Exception $e) {
    echo "<script language=\"JavaScript\">\r\n";
    echo " alert(\"Message could not be sent. Mailer Error: {$mail->ErrorInfo}\");\r\n";
    echo " window.location.href='setting_mail.php'\r\n";
    echo "</script>";
    exit;
    //echo '<script>SendFailedMessage();</script>';
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    //echo "<script>window.location.href='./setting_mail.php'</script>";
}
