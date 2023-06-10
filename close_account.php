<?php

include 'db_connect.php';

try {
    if (!isset($_POST['email']) && isset($_POST['password'])) {
        throw new Exception("Please enter all the fields...!");
    }
    // storing user email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to fetch user_id based on his email and password
    $sql = "SELECT user_id FROM users WHERE email = '$email' AND password = '$password' ";
    $result = $conn->query($sql);
    $row;

    if (!$row = $result->fetch_assoc()) {
        throw new Exception("Please Check the user credentials");
    }

    $user_id = $row['user_id'];

    // Query to delete user and all his transaction
    $sql = "SELECT user_id FROM movements WHERE user_id = '$user_id' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "DELETE FROM movements WHERE user_id = '$user_id'";
        $conn->query($sql);

        if (!$conn->affected_rows > 0) {
            throw new Exception("There was some problem deleting your account...!");
        }
    }

    $sql = "DELETE FROM users WHERE user_id = '$user_id'";
    $conn->query($sql);

    if (!$conn->affected_rows > 0) {
        throw new Exception("There was some problem deleting your account...!");
    }

    $conn->close();

    $response = array(
        'status' => 'success',
    );

} catch (Exception $e) {
    $response = array(
        'status' => 'error',
        'message' => $e->getMessage()
    );
}
header('Content-Type: application/json');
echo json_encode($response);
?>