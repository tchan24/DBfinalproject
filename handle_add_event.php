<?php
$servername = "localhost";
$username = "postgres";
$password = "admin";
$dbname = "tarun";

try {
    $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $conn->prepare("INSERT INTO evm.event (event_id, host, ticket_price, event_name, event_date, description, event_location, organize_id) VALUES (:event_id, :host, :ticket_price, :event_name, :event_date, :description, :event_location, :organize_id)");

        $stmt->execute([
            'event_id' => $_POST['event_id'],
            'host' => $_POST['host'],
            'ticket_price' => $_POST['ticket_price'],
            'event_name' => $_POST['event_name'],
            'event_date' => $_POST['event_date'],
            'description' => $_POST['description'],
            'event_location' => $_POST['event_location'],
            'organize_id' => $_POST['organize_id']
        ]);

        echo "Event added successfully.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>