<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Add any additional CSS or meta tags here -->
</head>
<body>
    <h2>Edit Event</h2>

    <?php
    $servername = "localhost";
    $username = "postgres";
    $password = "admin";
    $dbname = "tarun";
    $event_id = $_GET['event_id']; // Get the event_id from the URL

    try {
        $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM evm.event WHERE event_id = :event_id");
        $stmt->execute(['event_id' => $event_id]);
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$event) {
            throw new Exception("Event not found");
        }
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
    ?>

    <form method="post" action="handle_edit_event.php">
        <input type="text" name="event_id" value="<?php echo htmlspecialchars($event['event_id']); ?>">
        Host: <input type="text" name="host" value="<?php echo htmlspecialchars($event['host']); ?>" required><br>
        Ticket Price: <input type="text" name="ticket_price" value="<?php echo htmlspecialchars($event['ticket_price']); ?>" required><br>
        Event Name: <input type="text" name="event_name" value="<?php echo htmlspecialchars($event['event_name']); ?>" required><br>
        Date: <input type="date" name="event_date" value="<?php echo htmlspecialchars($event['event_date']); ?>" required><br>
        Description: <textarea name="description" required><?php echo htmlspecialchars($event['description']); ?></textarea><br>
        Location: <input type="text" name="location" value="<?php echo htmlspecialchars($event['location']); ?>" required><br>
        Organize ID: <input type="text" name="organize_id" value="<?php echo htmlspecialchars($event['organize_id']); ?>" required><br>
        <input type="submit" value="Update Event">
    </form>

    <form method="post" action="handle_delete_event.php" onsubmit="return confirm('Are you sure you want to delete this event?');">
        <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event['event_id']); ?>">
        <input type="submit" value="Delete Event" style="background-color: red; color: white;">
    </form>
</body>
</html>
