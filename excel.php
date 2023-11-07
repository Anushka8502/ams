<?php
error_reporting(E_ERROR | E_PARSE);

$fromDate = date('Y-m-d 00:00:00', strtotime($_GET['fromDate']));
$toDate = date('Y-m-d 23:59:59', strtotime($_GET['toDate']));
$employeeName = $_GET['employeeName'];
$departmentName = isset($_GET['departmentName']) ? $_GET['departmentName'] : '';
$status = $_GET['status'];

$name = "individual_training";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=" . $name . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once 'class/dbconnect.php';

// Handle Search button action
  $query = "SELECT * FROM visitor_entry WHERE date_in BETWEEN '$fromDate' AND '$toDate'";

  // Add the employee name filter if it is provided
  if (!empty($employeeName)) {
    $query .= " AND employee_name LIKE '%$employeeName%'";
  }

  // Add the department name filter if it is provided
  if (!empty($departmentName)) {
    $query .= " AND department_name = '$departmentName'";
  }

    if (!empty($status) && $status !== "both") {
    if ($status === "checked-in") {
      $query .= " AND date_out = '0000-00-00 00:00:00'";
    } elseif ($status === "checked-out") {
      $query .= " AND date_out BETWEEN '$fromDate' AND '$toDate' AND date_out != '0000-00-00 00:00:00'";
    }
  }

  $query .= " ORDER BY uniqueid DESC";
  

  // Execute the modified SQL query to retrieve visitor entries

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    echo "<table border='1' cellpadding='0' cellspacing='0'><tbody>";
	echo $query;
	echo $employeeName;
	echo $departmentName;
	echo $status;
    echo "<tr>
        <th>Id</th>
        <th>Name</th>
        <th>Mobile number</th>
		<th>Email</th>
        <th>Visitor Type</th>
        <th>EIS Number</th>
        <th>Identification Type</th>
        <th>Identification Number</th>
        <th>Address</th>
        <th>Employee Name</th>
        <th>Department</th>
        <th>Purpose</th>
        <th>In Time</th>
        <th>Out Time</th>
    </tr>";

    while ($res = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $res['uniqueid'] . "</td>
            <td>" . $res['name'] . "</td>
            <td>" . $res['mobile_no'] . "</td>
			<td>" . $res['email'] . "</td>
            <td>" . $res['visitor_type'] . "</td>
            <td>" . $res['eis_no'] . "</td>
            <td>" . $res['identification_type'] . "</td>
            <td>" . $res['identification_no'] . "</td>
            <td>" . $res['address'] . "</td>
            <td>" . $res['employee_name'] . "</td>
            <td>" . $res['department_name'] . "</td>
            <td>" . $res['purpose'] . "</td>
            <td>" . $res['date_in'] . "</td>
            <td>" . $res['date_out'] . "</td>
        </tr>";
    }

    $result->free_result();
    echo "</tbody></table>";
} else {
    // No entries found for the selected dates or filters.
}

$conn->close();
?>


