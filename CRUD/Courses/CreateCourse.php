<?php
include_once 'Database/Data.php';
include_once 'Forms/Add_Course_Form.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $course_name = $_POST['course_name'];
    $cost = $_POST['Cost'];

    // Initialize a database connection
    $conn = connectToDatabase();

    // Check if the connection was successful
    if ($conn) {
        // Prepare SQL statement
        $sql = "INSERT INTO courses (course_name, Cost) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute query
        $stmt->bind_param("ss", $course_name, $cost);
        if ($stmt->execute()) {
            echo "Course created successfully.";
        } else {
            echo "Error creating Course: " . $stmt->error;
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Failed to connect to the database.";
    }
}



