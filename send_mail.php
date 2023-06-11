<?php

use PHPMailer\PHPMailer\PHPMailer;

// use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
// Generate random OTP
function generateOTP()
{
    // Generate a random 6-digit OTP
    return strval(mt_rand(100000, 999999));
}

// Send custom mail
function sendMail($email, $subject, $message)
{
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $mail = new PHPMailer;

    // Set up SMTP credentials and server
    $smtpHost = 'smtp.gmail.com';
    $smtpPort = 465;
    $smtpUsername = 'rahuljmusic99@gmail.com';
    $smtpPassword = 'qeqpzvcmnsdgvfcu';

    // Set SMTP configuration
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->Port = $smtpPort;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;

    // Set sender and recipient
    $mail->setFrom($smtpUsername, 'Bankify');
    $mail->addAddress($email);

    // Set email content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send the email
    if ($mail->send()) {
        return true; // Email sent successfully
    } else {
        return false; // Failed to send email
    }
}


?>