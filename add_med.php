<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tele";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['save1']))
{
$Medication = $_POST['Medication'];



$sql_query = "INSERT INTO preliminary_medication (Medication)
	 VALUES ('$Medication')";

	if (mysqli_query($conn, $sql_query)) 
	{
  		echo "<script>alert('Medication Added Successfully!');</script>";
   		echo "<script>window.history.back();</script>";
	} 
	 else
     {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>