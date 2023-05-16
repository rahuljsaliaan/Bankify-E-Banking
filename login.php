<?php

include 'db_connect.php';
// start the session
session_start();

// check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // validate the form data
    if (empty($email) || empty($password)) {
        // return an error message if any field is empty
        $response = 'Please fill in all fields';
        echo json_encode($response);
    } else {

        // check the username and password against the database
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) >= 1) {
            $row = mysqli_fetch_assoc($result);
            // the login is successful, set session variables and return success message
            $_SESSION['username'] = $email;
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $response = "success";
            echo json_encode($response);
        } else {
            // the login failed, return error message
            $response = "invalid user name or password...!";
            echo json_encode($response);
        }
    }
}