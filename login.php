<?php

session_start();
include_once 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $Reg_number = $password = "";
    
    // Processing form data when form is submitted
    $Reg_number = trim($_POST["Reg_number"]);
    $password = trim($_POST["password"]);
    
    // Prepare a select statement
    $sql = "SELECT * FROM register WHERE Reg_number = ? AND Password = ?";
    
    if ($stmt = $con->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ss", $param_Reg_number, $param_password);
        
        // Set parameters
        $param_Reg_number = $Reg_number;
        $param_password = $password;
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Store result
            $stmt->store_result();
            
            // Check if Reg_number and password exist, if yes then login
            if ($stmt->num_rows == 1) {                    
                // Set session variables for login status and Reg_number
                $_SESSION['loggedin'] = true;
                $_SESSION['Reg_number'] = $Reg_number;
                // Redirect to student4.html
                echo '<script>alert("Login Successful."); window.location.href = "student4.html";</script>';
                exit;
            } else {
                // Display an error message if Reg_number or password is incorrect
                echo 'Incorrect Reg_number or Password';
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    
    // Close statement
    $stmt->close();
    
    // Close connection
    $con->close();
}
?>
