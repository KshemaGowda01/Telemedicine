<?php
// Get symptoms from URL parameter
$symptoms = $_GET['symptoms'];

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "tele");

// Check connection
if (!$conn) {
  die("Connection failed: ". mysqli_connect_error());
}

// Split the symptoms into an array
$symptoms_array = explode(",", $symptoms);

// Get the corresponding disease IDs from the SDMapping table
$disease_ids = array();
foreach ($symptoms_array as $symptom) {
  // Get the Sid from the Symptoms table
  $query = "SELECT Sid FROM Symptoms WHERE Sname = '$symptom'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $sid = $row['Sid'];

  // Get the Did from the SDMapping table
  $query = "SELECT Did FROM SDMapping WHERE Sid = $sid";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $disease_ids[] = $row['Did'];
  }
}

// Get the most common disease ID (assuming it's the correct one)
$disease_id = array_count_values($disease_ids);
arsort($disease_id);
$disease_id = key($disease_id);

// Get the disease name from the Disease table
$query = "SELECT Dname FROM Disease WHERE Did = $disease_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$disease_name = $row['Dname'];

// Get all medications for the most relevant disease from the DMMapping table
$query = "SELECT M.Medication FROM DMMapping JOIN Preliminary_Medication M ON DMMapping.PMid = M.PMid WHERE DMMapping.Did = $disease_id";
$result = mysqli_query($conn, $query);

// Display the results
echo '<div style="width: 80%; margin: 40px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">';
echo "<h2>You have been diagnosed with:</h2><h3> $disease_name</h3>";
echo "<h2>Recommended Medications:</h2>";
echo "<h3><ul>";
while ($row = mysqli_fetch_assoc($result)) {
  echo "<li><h4>". $row['Medication']. "</h4></li>";
}
echo "</ul></h3>";
echo "<h5>Note: This is a preliminary medication. Please consult a doctor for further treatment.</h5>";
echo '</div>';

// Add logout button
echo '<div style="text-align: center;">';
echo '<a href="index.html" class="logout-btn">Logout</a>';
echo '</div>';

// Style the logout button
echo '<style>
  .logout-btn {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    
  }
  .logout-btn:hover {
    background-color: #444;
  }
</style>';

// Close the connection
mysqli_close($conn);
?>