<?php

// Check if the request method is POST (form submission)
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve username and password from POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection parameters
    $host = "localhost"; // Database host
    $dbUsername = "root"; // Database username
    $dbpassword = ""; // Database password
    $dbname = "auth"; // Database name

    // Create a new MySQLi connection
    $conn = new mysqli($host, $dbUsername, $dbpassword, $dbname);

    // Check if the connection was successful
    if($conn->connect_error) {
        // If connection failed, display error and stop execution
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query to validate login credentials
    $query = "SELECT * FROM login where username = '$username' AND password = '$password'";
    $result = $conn->query($query); // Execute the query

    // Check if exactly one user matches the credentials
    if ($result->num_rows == 1) {
        // login successful: redirect to success page
        header("Location: success.html");
        exit();
        // redirect to another page or perform other actions
    } else {
        // login failed: redirect to failed page
        header("location: failed.html"); 
        exit();
    }
    // Close the database connection
    $conn->close();
}

// End of PHP script
?>