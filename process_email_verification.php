<?php

require 'send_mail.php';

session_start();

if (isset($_POST['email'])) {
    $email = $_POST['email'];

}

?>