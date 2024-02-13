<!DOCTYPE html>
<html>
<head>
    <title>Add New Event</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Add any additional CSS or meta tags here -->
</head>
<body>
    <h2>Add New Event</h2>

    <form method="post" action="handle_add_event.php">
        Event ID: <input type="text" name="event_id"><br>
        Host: <input type="text" name="host" required><br>
        Ticket Price: <input type="text" name="ticket_price" required><br>
        Event Name: <input type="text" name="event_name" required><br>
        Date: <input type="date" name="event_date" required><br>
        Description: <textarea name="description" required></textarea><br>
        Location: <input type="text" name="event_location" required><br>
        Organize ID: <input type="text" name="organize_id" required><br>
        <input type="submit" value="Add Event">
    </form>
</body>
</html>
