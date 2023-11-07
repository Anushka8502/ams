<?php
$to_email = "samaira2313@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi, This is test email send by PHP Script";
$headers = "From: ambekaranushka8502@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent ";
} else {
    echo "Email sending failed...";
}
?>

