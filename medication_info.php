<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tele";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Retrieve the symptom info from the database
$sql = "SELECT * FROM preliminary_medication";
$result = $conn->query($sql);

// Display the data in a table
echo "<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f0f0f0;
    }
</style>";

echo "<table>";
echo "<tr><th>Medication ID</th><th>Medication Name</th></tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>". $row["PMid"]. "</td>";
        echo "<td>". $row["Medication"]. "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='2'>No Medication found</td></tr>";
}

echo "</table>";
echo "<br>";
echo "<button onclick=\"window.history.back()\">Back</button>";
?>