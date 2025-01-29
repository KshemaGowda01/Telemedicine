<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Dummy authentication logic
    if ($username === 'admin' && $password === 'admin') {
        header('Location: dashboard.html');
        exit();
    } else {
        $message = 'Invalid credentials';
        echo "<script>alert('$message'); window.location.href='admin.html';</script>";
    }
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>TELEVAIDHYA</h1>
    </header>
    <nav>
        <a href="index.html">Home</a>
        <a href="about.html">About Us</a>
        <a href="contact.html">Contact Us</a>
        <a href="#" class="active">Admin</a>
        <a href="login.html">Login</a>
    </nav>
    <div class="container">
       
        <form id="admin-form" method="POST" action="admin.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($message)): ?>
            <p id="message"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
