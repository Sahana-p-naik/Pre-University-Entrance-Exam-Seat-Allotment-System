<?php
require_once 'connection.php';

// Check if the data was submitted
if (!isset($_POST['name'], $_POST['reg_number'], $_POST['mobile'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $_POST['selectedSecretQuestion'])) {
    // Data is missing
    exit('Please complete the registration form!');
}

// Check for empty fields
if (empty($_POST['name']) || empty($_POST['reg_number']) || empty($_POST['mobile']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirmPassword']) || empty($_POST['selectedSecretQuestion'])) {
    // One or more fields are empty
    exit('Please complete the registration form');
}

// Validate password match
if ($_POST['password'] !== $_POST['confirmPassword']) {
    exit('Passwords do not match!');
}

// Insert data into the database
if ($stmt = $con->prepare('INSERT INTO register(name, reg_number, mobile, email, password, secret_question, secret_answer) VALUES (?, ?, ?, ?, ?, ?, ?)')) {
    // Hash the password before saving it to the database
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // Bind parameters and execute the statement
    $stmt->bind_param('ssissss', $_POST['name'], $_POST['reg_number'], $_POST['mobile'], $_POST['email'], $_POST['password'], $_POST['selectedSecretQuestion'], $_POST[$_POST['selectedSecretQuestion']]);
    if ($stmt->execute()) {
        echo '<script>alert("Registered Successfuly."); window.location.href = "login.html";</script>';
    } else {
        echo 'Registration failed';
    }
    $stmt->close();
} else {
    echo 'Could not prepare statement!';
}
?>
