<!DOCTYPE html>
<html>
<head>
    <title>Event List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Add any additional CSS or meta tags here -->
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h2>Event List</h2>
    <a href="add_event.php">Add Event</a> <!-- Link to Add Event Page -->

    <?php
    // Database connection details
    $servername = "localhost";
    $username = "postgres";
    $password = "admin";
    $dbname = "tarun";

    try {
        $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch events
        $stmt = $conn->prepare("SELECT * FROM evm.event");
        $stmt->execute();
        $result = $stmt->fetchAll();

        // Display events
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Host</th><th>Ticket Price</th><th>Event Name</th><th>Date</th><th>Description</th><th>Location</th><th>Edit</th></tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['event_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['host']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ticket_price']) . "</td>";
            echo "<td>" . htmlspecialchars($row['event_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['event_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
            echo "<td>" . htmlspecialchars($row['event_location']) . "</td>";
            echo "<td><a href='edit_event.php?event_id=" . $row['event_id'] . "'>Edit</a></td>"; // Link to Edit Event Page
            echo "</tr>";
        }
        echo "</table>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
</body>
</html>
