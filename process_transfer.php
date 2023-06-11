<?php
require 'db_connect.php';

session_start();
$user_id;
if (isset($_SESSION['loggedin']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: index.php");
    exit();
}

try {
    $receiverAcc = $_POST['receiverAcc'];
    $amount = $_POST['amount'];
    $sender_user_id = $_SESSION['user_id'];


    if (empty($receiverAcc) || empty($amount) || empty($sender_user_id)) {
        throw new Exception("Please enter all the fields");
    }

    // Begin transaction
    $conn->begin_transaction();

    // Check if there is sufficient balance in the senders account
    $sql = "SELECT amount FROM movements WHERE user_id = '$sender_user_id'";
    $result = $conn->query($sql);
    $totalBalance = 0;

    // check for insufficient balance
    if ($result->num_rows == 0) {
        throw new Exception("Insufficient balance. Please check your balance before transferring amount");
    }

    while ($row = $result->fetch_assoc()) {
        $totalBalance += intval($row['amount']);
    }

    if ($amount > ($totalBalance - 100)) {
        throw new Exception("Insufficient balance. Please check your balance before transferring amount");
    }

    // Check if user exists 
    $sql = "SELECT user_id FROM users WHERE email = '$receiverAcc'";
    $result = $conn->query($sql);


    if (!$row = $result->fetch_assoc()) {
        throw new Exception("User with email id \"$receiverAcc\" does not exists");
    }

    // Deduct from senders account
    $sql = "INSERT INTO movements (user_id,amount) values('$sender_user_id','-$amount')";
    $conn->query($sql);
    if (!$conn->affected_rows > 0) {
        throw new Exception("There was some problem transferring amount to \"$receiverAcc\", please try again later");
    }


    // Transfer to receiverAcc
    $receiverAcc_user_id = $row['user_id'];

    $sql = "INSERT INTO movements (user_id,amount) values('$receiverAcc_user_id','$amount')";
    $conn->query($sql);
    if (!$conn->affected_rows > 0) {
        throw new Exception("There was some problem transferring amount to \"$receiverAcc\", please try again later");
    }

    // commit changes
    $conn->commit();
    $conn->close();

    $response = array(
        'status' => 'success',
    );

} catch (Exception $e) {
    // Rollback transaction
    $conn->rollback();

    // Close the connection
    $conn->close();

    // Prepare error response
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