<?php
// login.php
$servername = "localhost";
$username = "postgres";
$password = "admin";
$dbname = "tarun";

// Create connection
try {
    $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $emp_email = $_POST["emp_email"];
        $emp_password = $_POST["emp_password"];

        // SQL to check user in the evm schema
        $stmt = $conn->prepare("SELECT * FROM evm.employee WHERE emp_email = :emp_email AND emp_password = :emp_password");

        $stmt->execute(['emp_email' => $emp_email, 'emp_password' => $emp_password]);

        if ($stmt->rowCount() == 1) {
            // Login successful, redirect to the dashboard or relevant page
            header("Location: events.php");
        } else {
            // Login failed, redirect back to login with error
            header("Location: index.php?error=1");
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
