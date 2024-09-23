<?php
// Include the database connection file
include 'connection.php';

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $Reg_number = $_POST['Reg_number'];
    $Exam_Rank = $_POST['Exam_Rank'];
    $Course_name = $_POST['Course_name'];
    $Course_id = $_POST['Course_id'];

    // Prepare and bind the SQL statement
    $stmt = $con->prepare("INSERT INTO result (Reg_number, Exam_Rank, Course_name, Course_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $Reg_number, $Exam_Rank, $Course_name, $Course_id);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Data inserted successfully
        $response = array("success" => true, "message" => "Data inserted into 'result' table successfully.");
        echo json_encode($response);
    } else {
        // Error in execution
        $response = array("success" => false, "message" => "Error inserting data into 'result' table: " . $stmt->error);
        echo json_encode($response);
    }

    // Close the statement
    $stmt->close();
} else {
    // Method not allowed
    $response = array("success" => false, "message" => "Method not allowed.");
    echo json_encode($response);
}
?>
