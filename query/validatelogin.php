<?php
require_once('../class/fetchip.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username1 = $_POST["attuser"];
    $password1 = $_POST["attpwd"];
    $first = $_POST["first"];
    $second = $_POST["second"];
    $sum = $_POST["sum"];

    if ($sum == $first + $second) {
        require('../class/dbconnect.php');
        error_reporting(E_ERROR | E_PARSE);
        
        // Check if the account is active
        $sql1 = "SELECT * FROM login WHERE username='$username1' AND password='$password1'";
        $result = $conn->query($sql1);
        $row = $result->fetch_assoc();

        if (mysqli_num_rows($result) > 0) {
            if ($row['active_flag'] == 'ACTIVE') {
                $_SESSION['ROLE'] = $row['ROLE'];
                $_SESSION['LOGIN_ID'] = $username1;

                $sql = "INSERT INTO USER_LOG (USERNAME, MODULE, ACTION, CREATE_DATE, USERIP)
                    VALUES ('".$_SESSION['LOGIN_ID']."', 'LOGIN', 'SUCCESSFUL', NOW(), '$ipaddress')";
                if ($conn->query($sql) === TRUE) {
                    echo "";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                echo "<script>location.href='../Welcome1.php'</script>";
            } else {
                echo "<script>alert('Your account is deactivated');history.back();</script>";
            }
        } else {
            $sql = "INSERT INTO USER_LOG (USERNAME, MODULE, ACTION, CREATE_DATE, USERIP)
                VALUES ('$username1', 'LOGIN', 'UNSUCCESSFUL', NOW(), '$ipaddress')";
            if ($conn->query($sql) === TRUE) {
                echo "";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            echo "<script>alert('Invalid Login Credentials');history.back();</script>";
        }
    } else {
        $sql = "INSERT INTO USER_LOG (USERNAME, MODULE, ACTION, CREATE_DATE, USERIP)
            VALUES ('$username1', 'LOGIN', 'INVALID CAPTCHA', NOW(), '$ipaddress')";
        if ($conn->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        echo "<script>alert('Invalid Captcha');history.back();</script>";
    }
} else {
    echo "<script>location.href='com/logout.php';</script>";
}
?>

