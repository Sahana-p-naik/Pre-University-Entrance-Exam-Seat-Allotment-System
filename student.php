<?php
// Include the connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $Reg_number = $First_name = $Middle_name = $Last_name = $email = $mobile = $exam_rank = $Date_of_Birth = $Street_address = $taluk = $district = $gender = $category = $reservation = "";
    
    // Processing form data when form is submitted
    $Reg_number = $_POST["Reg_number"];
    $First_name = $_POST["First_name"];
    $Middle_name = $_POST["Middle_name"];
    $Last_name = $_POST["Last_name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $exam_rank = $_POST["exam_rank"];
    $Date_of_Birth = $_POST["Date_of_Birth"];
    $Street_address = $_POST["Street_address"];
    $taluk = $_POST["taluk"];
    $district = $_POST["district"];
    $gender = $_POST["gender"];
    $category = $_POST["category"];
    $reservation = $_POST["reservation"];

    // Prepare and bind parameters for inserting data into the database
    if ($stmt = $con->prepare('INSERT INTO student(Reg_number, First_name, Middle_name, Last_name, email, mobile, exam_rank, Date_of_Birth, Street_address, taluk, district, gender, category, reservation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
        $stmt->bind_param('sssssiisssssss', $Reg_number, $First_name, $Middle_name, $Last_name, $email, $mobile, $exam_rank, $Date_of_Birth, $Street_address, $taluk, $district, $gender, $category, $reservation);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to college.html
            
            echo '<script>alert("Data submitted Succesfuly."); window.location.href = "college.html";</script>';
            exit;
        } else {
            echo 'Registration failed';
        }
        $stmt->close();
    } else {
        echo 'Could not prepare statement!';
    }

    // Close the database connection
    $con->close();
}
?>
