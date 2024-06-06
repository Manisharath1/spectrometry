<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback = $_POST['feedback'];
    
    // Here, you can process the feedback, e.g., save it to a database
    // For simplicity, we just return a success message
    
    echo json_encode(["status" => "success", "message" => "Feedback submitted successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
