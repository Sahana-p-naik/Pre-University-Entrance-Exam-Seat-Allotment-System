<?php


// Database connection parameters
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'Supmysql@2004';
$DATABASE_NAME = 'dbms_project';

// Attempt to establish a connection to the database
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Check connection status
if (mysqli_connect_errno()) {
    // If connection failed, display an error message
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>
