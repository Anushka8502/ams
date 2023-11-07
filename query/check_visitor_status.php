<?php
require_once('../class/dbconnect.php');

$mobileNumber = $_POST['mobile_no'];

$sql = "SELECT date_out FROM visitors WHERE mobile_no = '$mobileNumber' ORDER BY date_out DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $dateOut = $row['date_out'];

    if ($dateOut == '0000-00-00 00:00:00.000000') {
        // Person has not checked out yet
        echo "not_checked_out";
    } else {
        // Person has checked out
        // You can add any additional code here if needed
    }
}

$conn->close();
?>





