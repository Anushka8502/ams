<?php
require_once('class/dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the username from the AJAX request
    $username = $_POST['username'];

    // Check if username exists in the database
    $checkSql = "SELECT * FROM login WHERE username = '$username'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "activated"; // Username exists, show as activated
    } else {
        echo "deactivated"; // Username doesn't exist, show as deactivated
    }
}
?>
