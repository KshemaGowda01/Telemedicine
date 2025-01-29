<?php
// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'tele';

$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

// Fetch patient info
$sql = "SELECT * FROM Patient_info";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $patients = [];
    while($row = mysqli_fetch_assoc($result)) {
        $patients[] = $row;
    }
    echo json_encode($patients);
} else {
    echo json_encode(['error' => 'No patient info found.']);
}

// Close connection
mysqli_close($conn);
?>