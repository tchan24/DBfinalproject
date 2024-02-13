<!DOCTYPE html>
<html>
<head>
    <title>Tickets</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Add any additional CSS or meta tags here -->
</head>
<body>

    <?php include 'navbar.php'; ?> <!-- Include the navbar -->

    <h2>Ticket List</h2>

    <!-- Search form -->
    <form method="post" action="attendees.php">
        Search by Name: <input type="text" name="search_name">
        <input type="submit" value="Search">
    </form>

    <?php
    // Database connection details
    $servername = "localhost";
    $username = "postgres";
    $password = "admin";
    $dbname = "tarun";

    try {
        $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty(trim($_POST["search_name"]))) {
            $search_name = trim($_POST["search_name"]);
            $stmt = $conn->prepare("SELECT * FROM evm.ticket WHERE att_email LIKE :search_name");
            $stmt->execute(['search_name' => "%$search_name%"]);
        } else {
            $stmt = $conn->prepare("SELECT * FROM evm.ticket");
            $stmt->execute();
        }

        $result = $stmt->fetchAll();

        // Display attendees
        echo "<table border='1'>";
        echo "<tr><th>Ticket ID</th><th>Email</th><th>Event ID</th><th>Purchase Date</th></tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ticket_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['att_email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['event_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['purchase_date']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
    $conn = null;
    ?>
</body>
</html>
