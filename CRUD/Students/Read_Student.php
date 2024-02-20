<?php
include_once('C:/Users/user/source/repos/TaskPhpProject/TaskPhpProject/Database/Data.php');
include_once 'Forms/Add_Student_Forms.php';
function readStudent($conn)
{
    // SQL query to select all students from the database
    $sql = "SELECT * FROM students";
    // Execute the query
    $result = $conn->query($sql);

    // Check if any students were found
    if ($result->num_rows > 0) {
        // Output data for each student
        echo "<h2>Student List</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<spam><strong> Name :</strong> " . $row["student_name"] . "</spam>";
            echo "<spam><strong> Email:</strong> " . $row["email"] . "</spam>";
            echo "<form method='post' action='CRUD/Students/DeleteStudent.php' style='display: inline; margin-left: 10px;'>";
            echo "<input type='hidden' name='student_id' value='" . $row['student_id'] . "'>";
            echo "<button type='submit' onclick=\"return confirm('Are you sure you want to delete this course?')\">Delete</button>";
            // Output any other relevant student details
            echo "</div>";
        }
    }
}

// Connect to the database
$conn = connectToDatabase();

// Check if the connection is successful
if ($conn) {
    // Call the function to fetch and display student data
    readStudent($conn);
    // Close the database connection
    $conn->close();
} else {
    // If the connection fails, display an error message
    echo "Failed to connect to the database.";
}