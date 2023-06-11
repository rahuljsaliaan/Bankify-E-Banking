<?php

require 'send_mail.php';

session_start();

if (isset($_POST['email'])) {
    $otp = generateOTP();
    $email = $_POST['email'];
    $subject = 'OTP Verification';
    $message = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
            margin-top: 0;
        }

        p {
            color: #555555;
            margin-bottom: 20px;
        }

        .otp {
            font-size: 24px;
            font-weight: bold;
            color: #0066cc;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #888888;
        }

        .logo-text {
            margin-inline: 30px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>OTP Verification</h1>
        <img class="logo-text" src="/img/logo.png" alt="Bankify"/>
        <p>Your OTP for verification is: <span class="otp"> ' . $otp . ' </span></p>
        <p>Please use this OTP to complete the verification process.</p>
        <p class="footer">Thank you!</p>
    </div>
</body>
</html>
';
    if (!sendMail($email, $subject, $message)) {
        $response = array(
            'status' => 'error',
            'message' => 'There was some problem sending mail to "' . $email . '"',
        );
    } else {
        // Set the session variable
        $_SESSION['otp_number'] = $otp;
        $_SESSION['email'] = $email;

        // Set the expiration time (in seconds)
        $expirationTime = 30; // 30 seconds

        // Set the session expiration timestamp
        $_SESSION['otp_number_expiry'] = time() + $expirationTime;

        $response = array(
            'status' => 'success',
        );
    }
}

if (isset($_POST['otp_input'])) {
    $otp_input = $_POST['otp_input'];
    if (!$_SESSION['otp_number_expiry'] > time()) {
        unset($_SESSION['otp_number']);
        unset($_SESSION['otp_number_expiry']);
        $response = array(
            'status' => 'error',
            'message' => 'OTP Time has expired'
        );
    }

    $otp_number = $_SESSION['otp_number'];
    if ($otp_number !== $otp_input) {
        $response = array(
            'status' => 'error',
            'message' => 'Wrong OTP Please check your email'
        );
    } else {
        $email = $_SESSION['email'];
        unset($_SESSION['otp_number']);
        unset($_SESSION['otp_number_expiry']);
        unset($_SESSION['email']);
        $_SESSION['verified_email'] = $email;
        $response = array(
            'status' => 'success',
        );
    }
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>