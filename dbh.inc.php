<?php
// Enable error reporting (disable in production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database credentials
$host = "localhost";
$dbname = "onemoreparty";
$user = 'marc93';
$pass = 'MarcMarques93';

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Set character set to UTF-8
$conn->set_charset('utf8mb4');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
