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
if(isset($_POST['save']))
{
$Dname = $_POST['Dname'];



$sql_query = "INSERT INTO disease (Dname)
	 VALUES ('$Dname')";

	if (mysqli_query($conn, $sql_query)) 
	{
   		echo "<script>alert('Disease Added Successfully!');</script>";
   		echo "<script>window.history.back();</script>";
	} 
	 else
     {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>