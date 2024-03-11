<?php
include 'function.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Process form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  
  if (sendMail($subject, $message, "info@blueskybartending.ng", $email, $name)) {
    // Return success response
    echo "success";
  } else {
    // Error uploading file
    echo "error";
  }
} else {
  // Return error response
  echo "error";
}
?>