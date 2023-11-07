<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Process the submitted form data

  // Example: Retrieve the mobile number and other form fields
  $mobileNumber = $_POST['mobileno'];
  // Retrieve other form fields here

  // Perform any necessary validation or data processing

  // Example: Insert the form data into the database
  // Connect to the database using your database credentials
  require_once('class/dbconnect.php');
  
  // Perform the database query or insertion
  // Example:
  $sql = "INSERT INTO visitor_entry (mobile_no) VALUES ('$mobileNumber')";
  // Execute the query

  // Check if the query was successful or handle any errors

  // Redirect or show success message
}
?>
