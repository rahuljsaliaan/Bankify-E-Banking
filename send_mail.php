<?php

// Generate random OTP
function generateOTP()
{
    // Generate a random 6-digit OTP
    return strval(mt_rand(100000, 999999));
}

// Send custom mail
function sendMail($email, $subject, $message)
{
    $to = $email;

    // Add additional headers if needed
    $headers = 'From: Bankify <rahuljsaliaan@gmail.com>';

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        return true; // Email sent successfully
    } else {
        return false; // Failed to send email
    }
}

?>