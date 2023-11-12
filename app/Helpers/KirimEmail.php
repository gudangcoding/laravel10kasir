<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function kirim_email($to, $name, $subject, $message, $attacchment)
{
    $mail = new PHPMailer(true);

    try {

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'emailkamu@gmail.com';
        $mail->Password   = 'PasswordKu!23';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('emailkamu@gmail.com', 'StockWorkers');
        $mail->addAddress($to, $name);

        $mail->addAttachment($attacchment);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function uploadGambar($gambar)
{
    //ubah base64 jadi string
    $entry = base64_decode($gambar);
    $image = imagecreatefromstring($entry);
    //echo $entry;
    // exit();
    $tgl = date('Y-m-d_H-i-s');
    $directory = "../upload/product_" . $tgl . ".jpg";
     // Menyimpan file di server dalam bentuk jpeg
    imagejpeg($image, $directory);
    //imagedestroy($image);
    // Menyimpan file di server
    //file_put_contents($image, $directory);
    
    
}
