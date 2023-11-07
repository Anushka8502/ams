<?php
 require_once('../class/dbconnect.php'); 
// Get the user id 
$eis_no = $_GET['r'];



$sql1 = "SELECT * FROM visitor_entry WHERE eis_no='$eis_no'";
$result = $conn->query($sql1);
$row = $result->fetch_assoc();
$queryResult[1] = $row['name'];
$queryResult[2] = $row['address'];
$queryResult[3] = $row['employee_name'];
$queryResult[4] = $row['department_name'];
$queryResult[5] = $row['purpose'];
$queryResult[6] = $row['gender'];
$queryResult[7] = $row['visitor_type'];
$queryResult[8] = $row['identification_no'];
$queryResult[9] = $row['mobile_no'];
$queryResult[10] = $row['identification_type'];
				
echo json_encode(array('A'=>$queryResult[1],'B'=>$queryResult[2],'C'=>$queryResult[3],'D'=>$queryResult[4],'E'=>$queryResult[5],'gender'=>$queryResult[6],'visitortype'=>$queryResult[7],'F'=>$queryResult[8],'G'=>$queryResult[9],'H'=>$queryResult[10]));
?>