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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Sanitize input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $confirm_password = mysqli_real_escape_string($conn, $confirm_password);

    // Check if passwords match
    if ($password!= $confirm_password) {
        $message = "Passwords do not match.";
        echo "<script>alert('$message'); window.location.href='signup.html';</script>";
        exit();
    }

    // Check if username or email already exists
    $sql = "SELECT * FROM Signup WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $message = "User already exists. Please choose a different username or email.";
        echo "<script>alert('$message'); window.location.href='signup.html';</script>";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query to insert user into database
    $sql = "INSERT INTO Signup (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = "Sign up successful! You can now login.";
        echo "<script>alert('$message'); window.location.href='login.html';</script>";
        exit();
    } else {
        $message = "Error signing up. Please try again.";
        echo "<script>alert('$message'); window.location.href='signup.html';</script>";
    }

    mysqli_close($conn);
}
?>