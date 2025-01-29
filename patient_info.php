<?php
// Retrieve data from query string
$data = array();
foreach ($_GET as $key => $value) {
    $data[$key] = $value;
}

// Display data in a table
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
</style>

<table>
<tr>
    <th>Patient ID</th>
    <th>Patient Name</th>
    <th>Date of Birth</th>
    <th>Age</th>
    <th>Gender</th>
    <th>Blood Group</th>
    <th>Symptoms</th>
</tr>
<tr>
    <td><?php echo $data['id']; ?></td>
    <td><?php echo $data['Pname']; ?></td>
    <td><?php echo $data['DOB']; ?></td>
    <td><?php echo $data['Age']; ?></td>
    <td><?php echo $data['Gender']; ?></td>
    <td><?php echo $data['BloodGroup']; ?></td>
    <td><?php echo $data['Symptoms']; ?></td>
</tr>
</table>;

echo "<br>";
echo "<button onclick=\"window.history.back()\">Back</button>";
?>
<?php
// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'tele';

$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve patient info from the database using ID
$id = $_GET['id'];
$sql = "SELECT * FROM Patient_info WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
} else {
    echo "No patient found with ID $id";
    exit;
}

// Close connection
mysqli_close($conn);
?>
