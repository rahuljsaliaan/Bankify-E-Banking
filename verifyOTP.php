<?php
session_start();
if (!isset($_SESSION['otp_number']) || !isset($_SESSION['otp_number_expiry']) || !isset($_SESSION['email'])) {
  header('location: verifyEmail.php');
}

header("Cache-Control: no-cache, must-revalidate");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Verify OTP</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://kit.fontawesome.com/3ddfee1394.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
  <script defer src="js/verifyOTP.js"></script>
  <link rel="shortcut icon" type="image/png" href="img/icon.png" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/utility.css" />
  <link rel="stylesheet" href="css/verifyOTP.css" />
</head>

<body>
  <div class="container">
    <header>
      <img class="logo-text" src="img/logo.png" alt="bankify logo" />
      <h3 class="header-title">Verify ""</h3>
    </header>
    <div class="shield-container">
      <i class="bx bxs-check-shield shield-icon"></i>
    </div>
    <h4 class="otp-title">Enter OTP</h4>
    <form id="validateOTPForm" action="">
      <div class="input-field">
        <input class="input-otp" maxlength="1" data-input="1" type="number" />
        <input class="input-otp" maxlength="1" data-input="2" type="number" disabled />
        <input class="input-otp" maxlength="1" data-input="3" type="number" disabled />
        <input class="input-otp" maxlength="1" data-input="4" type="number" disabled />
        <input class="input-otp" maxlength="1" data-input="5" type="number" disabled />
        <input class="input-otp" maxlength="1" data-input="6" type="number" disabled />
        <input type="hidden" id="otpInput" disabled name="otp_input" value="">
      </div>
      <button type="submit" class="verify-btn" disabled>Verify</button>
    </form>
  </div>
</body>

</html>