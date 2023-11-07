<?php
require_once('../class/dbconnect.php');

// Check if mobile number or EIS number is provided
if (isset($_GET['q'])) {
    $mobileNo = $_GET['q'];
    $condition = "mobile_no='$mobileNo'";
} elseif (isset($_GET['r'])) {
    $eisNo = $_GET['r'];
    $condition = "eis_no='$eisNo'";
}

if (isset($condition)) {
    //$sql = "SELECT * FROM visitor_entry WHERE $condition";
	 $sql = "SELECT * FROM visitor_entry WHERE $condition UNION SELECT * FROM employee_master WHERE $condition";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $queryResult['A'] = $row['name'];
        $queryResult['B'] = $row['address'];
        $queryResult['C'] = $row['employee_name'];
        $queryResult['D'] = $row['department_name'];
        $queryResult['E'] = $row['purpose'];
        $queryResult['gender'] = $row['gender'];
        $queryResult['visitortype'] = $row['visitor_type'];
        $queryResult['F'] = $row['identification_no'];
        $queryResult['G'] = $row['eis_no'];
        $queryResult['H'] = $row['identification_type'];
		 $queryResult['I'] = $row['mobile_no'];

        echo json_encode($queryResult);
    }
}
?>
