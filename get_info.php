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
        $owner = $row['first_name'];
        $owner = $owner . ' ' . $row['last_name'];
        $interestRate = $row['interest_rate'];
        $currency = $row['currency'];
        $locale = $row['locale'];
        $username = $row['email'];
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
        'owner' => $owner,
        'movements' => $amounts,
        'interestRate' => $interestRate,
        'movementsDates' => $dateTimes,
        'currency' => $currency,
        'locale' => $locale,
    );

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>