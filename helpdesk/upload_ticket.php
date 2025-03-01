<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "helpdesk_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST["subject"];
    $description = $_POST["description"];
    $status = "Open";
    
    // Handle file upload
    $targetDir = "uploads/";
    $fileName = basename($_FILES["attachment"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFilePath);

    $sql = "INSERT INTO tickets (subject, description, status, attachment) VALUES ('$subject', '$description', '$status', '$fileName')";
    if ($conn->query($sql) === TRUE) {
        echo "Ticket submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
