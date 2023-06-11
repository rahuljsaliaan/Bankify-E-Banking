<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=\, initial-scale=1.0" />
  <title>Verify Email</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://kit.fontawesome.com/3ddfee1394.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
  <script defer src="js/verifyEmail.js"></script>
  <link rel="shortcut icon" type="image/png" href="img/icon.png" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/utility.css" />
  <link rel="stylesheet" href="css/verifyEmail.css" />
</head>

<body>
  <div class="container">
    <header>
      <img class="logo-text" src="img/logo.png" alt="bankify logo" />
      <h1 class="main-title">Sign up with bankify now</h1>
      <h3 class="sub-title">Verify your email</h3>
    </header>
    <form action="process_email_verification.php" method="post" id="validateEmailForm">
      <div class="input-container">
        <i class="bx bxs-envelope mail-icon"></i>
        <input type="text" class="email-input" id="email" name="email" />
      </div>
      <button type="submit" class="verify-btn" disabled>Send OTP</button>
    </form>
  </div>
</body>

</html>