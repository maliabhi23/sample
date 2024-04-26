<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$database = "mads";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$taskName = $_POST['taskName'];
$priority = $_POST['priority'];
$date = $_POST['date'];
$time = $_POST['time'];

// Prepare SQL statement to insert data
$sql = "INSERT INTO `mtasks`(`task_name`, `priority`, `task_date`, `task_time`) VALUES ('$taskName','$priority','$date','$time');";

if ($conn->query($sql) === TRUE) {
    echo "Task added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
