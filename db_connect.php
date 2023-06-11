<?php
session_start();
$user_id;
if (isset($_SESSION['loggedin']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: index.php");
    exit();
}

$usernameDb = 'root';
$password = '';
$dbName = 'bankify';
$serverName = 'localhost';

$conn = new mysqli($serverName, $usernameDb, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>