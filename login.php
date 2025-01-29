<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tele"; // Replace with your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_input = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize input to prevent SQL injection
    $login_input = mysqli_real_escape_string($conn, $login_input);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if user exists
    $sql = "SELECT * FROM Signup WHERE (username = BINARY '$login_input' OR email = BINARY '$login_input')";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['Uid'] = $row['Uid'];
            $_SESSION['username'] = $row['username'];
            $message = "Login successful!";
            echo "<script>alert('$message'); window.location.href='pinfo.html';</script>";
            exit();
        } else {
            $message = "Invalid password.";
            echo "<script>alert('$message'); window.location.href='login.html';</script>";
        }
    } else {
        $message = "No user found with this username or email.";
        echo "<script>alert('$message'); window.location.href='signup.html';</script>";
    }

    mysqli_close($conn);
}
?>