<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mobileno = $_POST["mobileno"];
    $email = $_POST["email"];
    $visitortype = $_POST["visitortype"];
    $eisNumber = isset($_POST["eisNumber"]) ? $_POST["eisNumber"] : ""; // Assuming 'eis_no' is the field name in your form
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $idtype = $_POST["idtype"];
    $idnumber = $_POST["idnumber"];
    $address = $_POST["address"];
    $employee_name = $_POST["employee_name"];
    $department_name = $_POST["department_name"];
    $purpose = $_POST["purpose"];

    require_once('../class/dbconnect.php');
    require_once('../class/fetchip.php');

    if (!empty($eisNumber)) {
        $nextunique = $eisNumber;
    } else {
        $nextunique = "default_value"; // Set a default value if 'eis_no' is empty
    }

    // Optionally, add any formatting or validation for 'nextunique' here

    // Continue with the rest of your code
    // ...

    $sql = "INSERT INTO visitor_entry (UNIQUEID, mobile_no, email, visitor_type, eis_no, name, gender, identification_type, identification_no, address, employee_name, department_name, purpose, date_in)
    VALUES ('$nextunique', '$mobileno', '$email', '$visitortype', '$eisNumber', '$name', '$gender', '$idtype', '$idnumber', '$address', '$employee_name', '$department_name', '$purpose', NOW())";



if ($conn->query($sql) === TRUE) {
	$sql = "INSERT INTO USER_LOG (USERNAME, MODULE,ACTION, CREATE_DATE, USERIP)
		VALUES ('".$_SESSION['LOGIN_ID']."', 'VISITOR INSERT','$nextunique', NOW(), '$ipaddress')";	
		if ($conn->query($sql) === TRUE) {
			echo "";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
  echo "<script>alert('Data Saved. Now click photo.');location.href='../test.php?qq=$nextunique';</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();  


?>
