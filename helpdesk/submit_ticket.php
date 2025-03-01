<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "helpdesk_db";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert ticket
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST["subject"];
    $description = $_POST["description"];
    $status = "Open";

    $sql = "INSERT INTO tickets (subject, description, status) VALUES ('$subject', '$description', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "New ticket created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

_____________________________________________________________________________________________

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "helpdesk_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST["subject"];
    $description = $_POST["description"];
    $status = "Open";

    $sql = "INSERT INTO tickets (subject, description, status) VALUES ('$subject', '$description', '$status')";
    
    if ($conn->query($sql) === TRUE) {
        sendEmailNotification($subject, $description);
        echo "Ticket created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();

function sendEmailNotification($subject, $description) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.yourmail.com'; // SMTP server (Gmail, Zoho, etc.)
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@example.com';
        $mail->Password = 'your-email-password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('your-email@example.com', 'Helpdesk Support');
        $mail->addAddress('admin@example.com', 'Admin');

        $mail->Subject = 'New Ticket Submitted';
        $mail->Body = "A new ticket has been submitted.\n\nSubject: $subject\nDescription: $description";

        $mail->send();
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
