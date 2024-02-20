<?php
include_once('C:\Users\user\source\repos\TaskPhpProject\TaskPhpProject\Database\Data.php');
$conn = connectToDatabase();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the course ID is set in the POST data
    if (isset($_POST['student_id'])) {
        // Get the course ID from the POST data
        $course_id = $_POST['student_id'];

        // Connect to the database
        $conn = connectToDatabase();

        // Prepare the SQL DELETE statement
        $sql = "DELETE FROM students WHERE student_id = ?";

        // Create a prepared statement
        $stmt = $conn->prepare($sql);

        // Bind the course ID parameter
        $stmt->bind_param("i", $course_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Course deleted successfully
            echo "Course deleted successfully.";
        } else {
            // Error deleting course
            echo "Error deleting course: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    }
}
