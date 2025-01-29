<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tele";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: ". mysqli_connect_error());
}
if(isset($_POST['save2']))
{
$Sname = $_POST['Sname'];



$sql_query = "INSERT INTO symptoms (Sname)
	 VALUES ('$Sname')";

	if (mysqli_query($conn, $sql_query)) 
	{
   		echo "<script>alert('Symptom Added Successfully!');</script>";
   		echo "<button class='back-btn' onclick='window.history.back()'>Back</button>";
   		
	} 
	 else
     {
		echo "Error: ". $sql. "". mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>