<?php
// Handle saving OTP to the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Process the submitted OTP data

  // Example: Retrieve the mobile number and OTP
  $mobileNumber = $_POST['mobileno'];
  $otp = $_POST['otp'];

  // Perform any necessary validation or data processing

  // Example: Update the database with the OTP
  // Connect to the database using your database credentials
  require_once('class/dbconnect.php');

  // Perform the database query or update
  // Example:
  $sql = "UPDATE visitor_entry SET otp = '$otp' WHERE mobile_no = '$mobileNumber'";
  // Execute the query

  // Check if the query was successful or handle any errors

  // Respond with a success message or error code
}
?>
