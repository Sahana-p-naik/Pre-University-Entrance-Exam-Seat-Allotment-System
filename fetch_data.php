
<?php
// Include the database connection file
include 'connection.php';

// Query to fetch data from the database
$query = "SELECT Reg_number, Exam_Rank, Course_name, Course_id FROM college1";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query was successful
if ($result) {
    // Array to store the fetched data
    $data = array();

    // Fetch rows from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Add each row to the data array
        $data[] = $row;
    }

    // Free the result set
    mysqli_free_result($result);

    // Close the database connection
    mysqli_close($con);

    // Send the data as JSON response
    echo json_encode($data);
} else {
    // If the query fails, return an error message
    echo json_encode(array('error' => 'Failed to fetch data from the database.'));
}
?>
