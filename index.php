<!DOCTYPE html>
<html>
<head>
    <title>Employee Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Add any additional CSS or meta tags here -->
</head>
<body>
    <h2>Employee Login</h2>

    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;">Invalid email or password.</p>
    <?php endif; ?>

    <form method="post" action="emplogin.php">
        Email: <input type="email" name="emp_email" required><br>
        Password: <input type="password" name="emp_password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>