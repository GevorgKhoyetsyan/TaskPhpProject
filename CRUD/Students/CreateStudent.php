<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('C:/Users/user/source/repos/TaskPhpProject/TaskPhpProject/Database/Data.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Retrieve form data
    $student_name = $_POST['student_name'];
    $email = $_POST['email'];
    $courses = $_POST['courses'];

    // Check if any of the form fields are empty
    if (empty($student_name) || empty($email) || empty($courses)) {
        echo "Please fill out all fields.";
    } else {
        // Initialize a database connection
        $conn = connectToDatabase();

        // Check if the connection was successful
        if ($conn) {
            // Insert the student data into the Students table
            $sql = "INSERT INTO Students (student_name, email,courses) VALUES (?, ?,?)";
            $stmt = $conn->prepare($sql);
            $courses_json = json_encode($courses);
            $stmt->bind_param("sss", $student_name, $email, $courses_json);
            // Execute the query to insert student data
            if ($stmt->execute()) {
                $student_id = $conn->insert_id; // Get the ID of the newly inserted student
            } else {
                echo "Error creating student: " . $stmt->error;
                exit; // Stop further execution if there's an error
            }
            $stmt->close();

            // Process selected courses and calculate total cost
            $total_cost = 0;
            foreach ($courses as $courseId => $courseData) {
                $num_classes = (int) $courseData['num_classes'];
                $sql = "SELECT Cost FROM courses WHERE course_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $courseId);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $course_cost = (int) $row['Cost'];
                    $total_course_cost = $course_cost * $num_classes;

                    $total_cost += $total_course_cost;
                } else {
                    echo "Error: Course with ID $courseId not found";
                    exit; // Stop further execution if there's an error
                }
            }

            // Apply discount if total cost exceeds $10,000
            if ($total_cost > 10000) {
                $discount_percentage = 30; // Discount percentage
                $discount_amount = ($total_cost * $discount_percentage) / 100;
                $moneyafterdiscount = $total_cost - $discount_amount;
            }

            // Output the total cost
            if ($total_cost > 10000) {
                echo "Student created successfully. Dear student, You have to pay $$total_cost Dollars, but you get a 30% discount and the final amount is $$moneyafterdiscount dollars.";
            } else {
                echo "Student created successfully. Total amount to pay for $student_name: $total_cost";
            }

            // Close database connection
            $conn->close();
        } else {
            echo "Failed to connect to the database.";
        }
    }
}