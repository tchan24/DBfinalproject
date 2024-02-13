<!DOCTYPE html>
<html>
<head>
    <title>Employees</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Add any additional CSS or meta tags here -->
</head>
<body>

    <?php include 'navbar.php'; ?> <!-- Include the navbar -->

    <h2>Employee List</h2>

    <!-- Search form -->
    <form method="post" action="employees.php">
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
            $stmt = $conn->prepare("SELECT * FROM evm.employee WHERE name LIKE :search_name");
            $stmt->execute(['search_name' => "%$search_name%"]);
        } else {
            $stmt = $conn->prepare("SELECT * FROM evm.employee");
            $stmt->execute();
        }

        $result = $stmt->fetchAll();

        // Display attendees
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Email</th><th>Birthdate</th><th>Security Level</th></tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['emp_email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['emp_birthdate']) . "</td>";
            echo "<td>" . htmlspecialchars($row['security_level']) . "</td>";
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
