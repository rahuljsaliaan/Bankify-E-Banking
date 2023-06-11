<?php
$usernameDb = 'root';
$password = '';
$dbName = 'bankify';
$serverName = 'localhost';

$conn = new mysqli($serverName, $usernameDb, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>