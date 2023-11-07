<?php
require_once('../class/dbconnect.php');
$unid=$_POST['unid'];
				$sql1="select * FROM visitor_entry where uniqueid='$unid'";
				$result = $conn->query($sql1);
				echo"<table class='table table-bordered table-striped box-body'>
                <tbody>
				<tr><td>Id</td><td>Name</td><td>In Time</td><td>Image</td><td>Out Time</td></tr>";
				while($row = $result->fetch_assoc()){
					echo"<tr><td>".$row['uniqueid']."</td><td>".$row['name']."</td>
					<td>".$row['date_in']."</td><td><img src='".$row['image']."' width='100' height='100'></td>
					<td>".$row['date_out']."</td></tr>";
				
				
				if ($row['date_out'] == '0000-00-00 00:00:00.000000') {
            echo "<tr><td colspan='5'><button type='submit' class='btn btn-info pull-right'>Check Out</button></td></tr>";
        } else {
            echo "<tr><td colspan='5'>Visitor is already checked out.</td></tr>";
        }
		
				}
				echo "</tbody></table>";

?>