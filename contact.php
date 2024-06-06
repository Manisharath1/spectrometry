<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email = htmlspecialchars(strip_tags(trim($_POST["email"])));
    $subject = htmlspecialchars(strip_tags(trim($_POST["subject"])));
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])));

    // Validate inputs
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Print inputs for debugging
        echo "Name: $name<br>";
        echo "Email: $email<br>";
        echo "Subject: $subject<br>";
        echo "Message: $message<br>";
    
        // Uncomment and configure the following to save to a database or send an email
        
        // Database configuration
        $servername = "localhost"; // Change this to your database server
        $username = "root";        // Change this to your database username
        $password = "";            // Change this to your database password
        $dbname = "contact_form_db"; // Change this to your database name
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO submissions (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
    
        // Execute the statement
        if ($stmt->execute()) {
            echo "Thank you! Your message has been sent and saved.";
        } else {
            echo "Sorry, there was an error saving your message. Please try again later.";
        }
    
        // Close the statement and connection
        $stmt->close();
        $conn->close();
        
    } else {
        echo "Please fill in all fields and provide a valid email address.";
    }
    } else {
    echo "Invalid request method.";
    }
    ?>