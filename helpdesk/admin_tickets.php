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

// Fetch tickets
$sql = "SELECT * FROM tickets ORDER BY id DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['subject']}</td>
                <td>
                    <form method='POST' action='update_status.php'>
                        <input type='hidden' name='ticket_id' value='{$row['id']}'>
                        <select name='status' onchange='this.form.submit()'>
                            <option ".($row['status']=='Open' ? 'selected' : '').">Open</option>
                            <option ".($row['status']=='In Progress' ? 'selected' : '').">In Progress</option>
                            <option ".($row['status']=='Closed' ? 'selected' : '').">Closed</option>
                        </select>
                    </form>
                </td>
                <td><a href='ticket.html?id={$row['id']}' class='btn btn-sm btn-info'>View</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No tickets found</td></tr>";
}
$conn->close();
?>
