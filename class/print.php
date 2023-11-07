<?php
require_once('../class/dbconnect.php');

if (isset($_GET['uniqueid'])) {
    $uniqueid = $_GET['uniqueid'];

    // Retrieve the visitor data with the specified unique ID
    $sql = "SELECT * FROM visitor_entry WHERE UNIQUEID = '$uniqueid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
	    $uniqueid=$row['uniqueid'];
        $name = $row['name'];
        $visitorType = $row['visitor_type'];
        $eisNumber = $row['eis_no'];
        $mobileNumber = $row['mobile_no'];
        $departmentName = $row['department_name'];
        $whomToVisit = $row['employee_name'];
        $image = $row['image'];
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Visitor ID Card</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                .id-card {
                    width: 8cm;
                    height: 9cm;
                    padding: 2mm;
                    border: 1px solid #000;
                    display: flex;
                }
                .id-card img {
                    width: 30mm;
                    height: 30mm;
                    margin-right: 10px;
					
                }
                .id-card-details {
                    flex-grow: 1;
                }
                .id-card h1, .id-card h3 {
                    margin: 0;
                    line-height: 0.7;
                }
                .id-card p {
                    margin-bottom: 0mm;
                    line-height:0.7;
                }
                .id-card h4 {
                    margin-bottom: 0mm;
                    line-height: 0.7;

            </style>
        </head>
        <body onload="window.print()">
    
	<div class="id-card">
  <table>
            <!-- First Row with Heading -->
<tr>
    <td style="vertical-align: middle;">
        <img src="wcllogo.png" alt="" style="width: 40px; height: 35px; margin-right: 10px; vertical-align: middle;">
        <h3 style="display: inline; margin: 0; vertical-align: middle; text-align:centre;">Western Coalfields Limited</h3>
    </td>
</tr>

            <!-- Second Row with Nested Tables and Data -->
            <tr>
                            <td style="text-align:center;">
                                <img style="border: 2px solid #000;"src="<?php echo $image; ?>" class="img-circle" alt="Visitor Photo">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <small><?php echo date('d-m-Y', strtotime($row['date_in']))." ".date('H:i:s', strtotime($row['date_in']));; ?></small>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <strong>ID no.:</strong><?php echo $uniqueid; ?><br/>
                                <?php echo $name; ?><br/>
                                <?php echo $visitorType ."  ".$eisNumber; ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <strong>Mobile no.:</strong><?php echo $mobileNumber; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>To Visit:</strong> <?php echo $departmentName. " (".$whomToVisit.") "; ?><br>
                            </td>
                        </tr>
						<tr>
                            <td style="text-align: center;">
								
<?php
	date_default_timezone_set('Asia/Kolkata');
	$date = date('d-m-y H:i:s');
?>															
							<small style="font-size: 10px;"><?php echo "printed on ".$date; ?>     (This card is valid for today only)</small>

							
                            </td>

                        </tr>
        </table>
</div>
 
</body>
        </html>

        <?php
    } else {
        echo "Visitor not found.";
    }
    $conn->close();
} else {
    // Display a form to enter the uniqueid
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Enter Unique ID</title>
    </head>
    <body>
        <form method="GET" action="">
            <label for="uniqueid">Enter Unique ID:</label>
            <input type="text" id="uniqueid" name="uniqueid" required>
            <input type="submit" value="Print">
        </form>
    </body>
    </html>
    <?php
}
?>

