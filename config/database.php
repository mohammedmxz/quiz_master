// config/database.php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_master";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
