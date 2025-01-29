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

// Get form data
$Pname = $_POST['Pname'];
$DOB = $_POST['DOB'];
$Age = $_POST['Age'];
$Gender = $_POST['Gender'];
$BloodGroup = $_POST['BloodGroup'];

// Get selected symptoms
$symptoms = [];
$symptom_values = array_filter($_POST['Symptoms']);
foreach ($symptom_values as $symptom_value) {
  $symptoms[] = $symptom_value;
}
$symptoms_string = implode(',', $symptoms);

// Insert data into database
$sql = "INSERT INTO Patient_info (Pname, Dob, Age, Gender, BloodGroup, Symptoms) VALUES ('$Pname', '$DOB', '$Age', '$Gender', '$BloodGroup', '$symptoms_string')";

if (mysqli_query($conn, $sql)) {
    // Redirect to result page
    header('Location: result.php?symptoms=' . $symptoms_string);
    exit;
} else {
    echo "Error: ". $sql. "<br>". mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>