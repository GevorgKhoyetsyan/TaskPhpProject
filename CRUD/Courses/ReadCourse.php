<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the database connection file
include_once 'Database/Data.php';
// Function to fetch and display course data
function getCourses($conn)
{
    // SQL query to select all courses from the database
    $sql = "SELECT * FROM courses";
    // Execute the query
    $result = $conn->query($sql);

    // Check if any courses were found
    if ($result->num_rows > 0)
    {
        // Output data for each course
        echo "<h2>Course List</h2>";
        while ($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "<span style='display:inline-block; width:150px;'>Course Name: ".$row["course_name"]."</span>";
        echo "<span>| Cost: $" .number_format($row["Cost"], 2) . "</span>";
        echo "<form method='post' action='CRUD/Courses/DeleteCourse.php' style='display: inline; margin-left: 10px;'>";
        echo "<input type='hidden' name='course_id' value='" . $row['course_id'] . "'>";
        echo "<button type='submit' onclick=\"return confirm('Are you sure you want to delete this course?')\">Delete</button>";
       }
     echo "</ul>";
    }
    else
    {
        // If no courses were found, display a message
        echo "No courses found.";
    }
}

// Connect to the database
$conn = connectToDatabase();

// Check if the connection is successful
if ($conn) {
    // Call the function to fetch and display course data
    getCourses($conn);
    // Close the database connection
    $conn->close();
} else {
    // If the connection fails, display an error message
    echo "Failed to connect to the database.";
}
