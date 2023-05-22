<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    header('location: dashboard.php');
}
header("Cache-Control: no-cache, must-revalidate");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <script src="https://kit.fontawesome.com/3ddfee1394.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="js/signup.js"></script>
    <link rel="shortcut icon" type="image/png" href="img/icon.png" />
    <link rel="stylesheet" href="css/utility.css" />
    <link rel="stylesheet" href="css/signup.css" />
</head>

<body>
    <section class="signup-modal">
        <div class="signup-modal-left">
            <a href="index.php"><img src="img/icon.png" alt="logo" tooltip="home"></a>
        </div>
        <div class="signup-modal-right">
            <form class="signup-modal-form" id="registerForm">
                <h3 class="signup-modal-title">Register for <img class="logo-text" src="img/logo.png" alt=""></h3>
                <div class="signup-modal-input-container">
                    <div class="signup-modal-input signup-modal-firstName">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName">
                    </div>
                    <div class="signup-modal-input signup-modal-lastName">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName">
                    </div>
                </div>
                <div class="signup-modal-input signup-modal-email">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                </div>

                <div class="signup-modal-input-container">
                    <div class="signup-modal-input signup-modal-currency">
                        <label for="currency">Currency</label>
                        <input type="text" readonly name="currency" id="currency">
                    </div>
                    <div class="signup-modal-input signup-modal-locale">
                        <label for="locale">Locale</label>
                        <input type="text" readonly name="locale" id="locale">
                    </div>
                </div>

                <div class="signup-modal-input-container">
                    <div class="signup-modal-input signup-modal-currency">
                        <label for="initialBalance">Initial Balance</label>
                        <input type="text" name="initialBalance" id="initialBalance">
                    </div>
                    <div class="signup-modal-input signup-modal-locale">
                        <label for="rot">Interest Rate</label>
                        <input type="text" readonly name="rot" id="rot">
                    </div>
                </div>

                <div class="signup-modal-input-container">
                    <div class="signup-modal-input signup-modal-password">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="signup-modal-input signup-modal-confirm-password">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" name="confirmPassword" id="confirmPassword">
                    </div>
                </div>

                <div class="signup-modal-input signup-modal-register">
                    <span id="errorMessage" class="error-message"></span>
                    <button class="btn-register" type="submit">Register</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>