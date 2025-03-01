<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "helpdesk_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticket_id = $_POST["ticket_id"];
    $status = $_POST["status"];

    $sql = "UPDATE tickets SET status='$status' WHERE id=$ticket_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.html"); // Redirect after update
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
?>
