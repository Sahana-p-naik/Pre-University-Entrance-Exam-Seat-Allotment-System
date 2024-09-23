<?php
include 'connection.php'; // Include the file with the database connection

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Reg_number = $_POST["Reg_number"];
    $Exam_Rank = $_POST["exam_rank"];
    $Course_name = $_POST["course_name"];
    $Course_id = $_POST["course_id"];

    // Prepare and bind the SQL statement
    $stmt = $con->prepare("INSERT INTO college1 (Reg_number, Exam_Rank, Course_name, Course_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $Reg_number, $Exam_Rank, $Course_name, $Course_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Display success message
        echo '<script>alert("Data Submitted successfully."); window.location.href = "home.html";</script>';
    } else {
        echo json_encode(array("message" => "Error inserting data into the database."));
    }

    // Close statement
    $stmt->close();
} else {
    // If the request method is not POST
    echo json_encode(array("message" => "Invalid request method."));
}

// Close connection
$con->close();
?>
