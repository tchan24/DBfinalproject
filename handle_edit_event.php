<?php
$servername = "localhost";
$username = "postgres";
$password = "admin";
$dbname = "tarun";

try {
    $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare SQL query to update event
        $sql = "UPDATE evm.event SET host = :host, ticket_price = :ticket_price, event_name = :event_name, event_date = :event_date, description = :description, event_location = :event_location, organize_id = :organize_id WHERE event_id = :event_id";

        $stmt = $conn->prepare($sql);

        // Bind parameters and execute statement
        $stmt->execute([
            'host' => $_POST['host'],
            'ticket_price' => $_POST['ticket_price'],
            'event_name' => $_POST['event_name'],
            'event_date' => $_POST['event_date'],
            'description' => $_POST['description'],
            'event_location' => $_POST['event_location'],
            'organize_id' => $_POST['organize_id'],
            'event_id' => $_POST['event_id']
        ]);

        echo "Event updated successfully.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
