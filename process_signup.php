<?php
include 'db_connect.php';

try {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $currency = $_POST['currency'];
    $locale = $_POST['locale'];
    $initialBalance = $_POST['initialBalance'];
    $ROI = $_POST['roi'];
    $password = $_POST['password'];


    if (empty($firstName) || empty($lastName) || empty($email) || empty($currency) || empty($locale) || empty($initialBalance) || empty($ROI) || empty($password)) {
        throw new Exception('Please fill in all the fields');
    }

    // Begin transaction
    $conn->begin_transaction();

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        throw new Exception("User '$email' already exists...!");
    }

    $sql = "INSERT INTO users (first_name,last_name,email,password,interest_rate,currency,locale) VALUES ('$firstName','$lastName','$email','$password','$ROI','$currency','$locale')";

    if (!$conn->query($sql)) {
        throw new Exception("There was some problem creating your account");
    }

    $sql = "SELECT user_id FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    $row;

    if (!$row = $result->fetch_assoc()) {
        throw new Exception("There was some problem creating your account");
    }

    $userId = $row['user_id'];

    $sql = "INSERT INTO movements (user_id,amount) VALUES('$userId','$initialBalance')";
    $result = $conn->query($sql);

    if (!$conn->affected_rows > 0) {
        throw new Exception("There was some problem creating your account");
    }

    // Commit transaction
    $conn->commit();

    // Close the connection
    $conn->close();

    $response = array(
        'status' => 'success',
    );

} catch (Exception $e) {
    // Rollback transaction
    $conn->rollback();

    // Close the connection
    $conn->close();

    $response = array(
        'status' => 'error',
        'message' => $e->getMessage()
    );
} finally {
    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}


?>