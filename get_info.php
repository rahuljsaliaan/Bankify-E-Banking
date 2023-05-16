<?php

include 'db_connect.php';
// start the session
session_start();

if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
    // Fetch user details
    $userDetails = array();
    $sql = "SELECT * FROM users WHERE user_id = $userID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found
        $row = $result->fetch_assoc();
        $userDetails['first_name'] = $row['first_name'];
        $userDetails['last_name'] = $row['last_name'];
        $userDetails['email'] = $row['email'];
    } else {
        // User not found
        $userDetails = null;
    }

    // Fetch movements
    $amounts = array();
    $dateTimes = array();
    $sql = "SELECT amount, date_time FROM movements WHERE user_id = $userID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Movements found
        while ($row = $result->fetch_assoc()) {
            $amounts[] = $row['amount'];
            $dateTimes[] = $row['date_time'];
        }
    } else {
        // No movements found
        $amounts = null;
        $dateTimes = null;
    }

    // Close the connection
    $conn->close();

    // Prepare response data
    $response = array(
        'userDetails' => $userDetails,
        'amounts' => $amounts,
        'dateTimes' => $dateTimes
    );

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>