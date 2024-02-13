<?php
$servername = "localhost";
$username = "postgres";
$password = "admin";
$dbname = "tarun";

try {
    $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $event_id = $_POST['event_id'];

        // Prepare SQL query to delete event
        $sql = "DELETE FROM evm.event WHERE event_id = :event_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['event_id' => $event_id]);

        // Redirect to the events page
        header("Location: events.php");
        exit;
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>