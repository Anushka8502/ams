<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uniqueid = $_POST["uniqueid"];

    require_once('../class/dbconnect.php');
require_once('../class/fetchip.php');

    $sql = "UPDATE visitor_entry SET date_out = NOW() WHERE uniqueid = '$uniqueid'";

    if ($conn->query($sql) === TRUE) {
		$sql = "INSERT INTO USER_LOG (USERNAME, MODULE,ACTION, CREATE_DATE, USERIP)
		VALUES ('".$_SESSION['LOGIN_ID']."', 'VISITOR OUT','CHECKED OUT', NOW(), '$ipaddress')";	
		if ($conn->query($sql) === TRUE) {
			echo "";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	
        echo "<script>location.href='../welcome1.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>