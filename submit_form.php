<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Recipient's email
    $to = "info@techerstore.com"; // Replace with your email

    // Subject of the email
    $subject = "New Contact Form Submission";

    // Email Body
    $body = "You have received a new message from $name ($email):\n\n$message";

    // Headers
    $headers = "From: $email";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Your message has been sent successfully!'); window.location.href='thank-you.html';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again later.'); window.location.href='contact.html';</script>";
    }
}
?>
