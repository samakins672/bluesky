<?php
include 'function.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Process form data
  $courseName = $_POST['course_name'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  // Upload proof of payment
  $targetDirectory = "../assets/images/uploads/";
  $proofOfPayment = $targetDirectory . basename($_FILES["proofOfPayment"]["name"]);
  $proofOfPaymentExtension = pathinfo($proofOfPayment, PATHINFO_EXTENSION);
  $proofOfPaymentNewName = $name . '_' . date("YmdHis") . '.' . $proofOfPaymentExtension;

  if (move_uploaded_file($_FILES["proofOfPayment"]["tmp_name"], $targetDirectory . $proofOfPaymentNewName)) {
    // File uploaded successfully
    // Send email to business with link to the uploaded proof
    $businessEmail = "info@blueskybartending.ng";
    $subject = "New Enrollment Form Submission";
    $message = "A new enrollment form has been submitted for the $courseName.<br><br>";
    $message .= "Student Name: $name<br>";
    $message .= "Student Email: $email<br>";
    $message .= "Student Phone: $phone<br>";
    $message .= "Proof of Payment: <a href='https://blueskybartending.ng/assets/images/uploads/$proofOfPaymentNewName'>View Proof</a>";
    sendMail($subject, $message, $businessEmail, $email, $name);
    
    // Send email to student
    $to = $email;
    $subject = "Enrollment Confirmation";
    $message = "Dear $name, <br>Your enrollment form for our $courseName has been received. We will contact you very soon.<br><br>Regards,<br>Bluesky Bartending";
    $b_name = "Bluesky Bartending";
    sendMail($subject, $message, $to, $businessEmail,  $b_name);

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