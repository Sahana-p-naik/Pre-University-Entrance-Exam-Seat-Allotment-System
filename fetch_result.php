<?php
// Include the database connection file
require_once 'connection.php';

// Check if the Reg_number is provided
if (isset($_GET['regNumber'])) {
    // Get the Reg_number from the request
    $regNumber = $_GET['regNumber'];

    // Prepare and execute the SQL query to fetch the result
    $sql = "SELECT * FROM result WHERE Reg_number = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $regNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row is fetched
    if ($result->num_rows > 0) {
        // Start the table
        echo "<table>";
        // Fetch the row
        $row = $result->fetch_assoc();
        // Iterate over each key-value pair in the row
        foreach ($row as $key => $value) {
            // Display each key-value pair as a table row
            echo "<tr><th>" . htmlspecialchars($key) . "</th><td>" . htmlspecialchars($value) . "</td></tr>";
        }
        // Close the table
        echo "</table>";
    } else {
        // If Reg_number not found, display "Seat not allocated"
        echo "Seat not allocated";
    }

    // Close the statement and database connection
    $stmt->close();
    $con->close();
} else {
    // If Reg_number is not provided, display an error message
    echo "Error: Registration Number not provided";
}
?>
