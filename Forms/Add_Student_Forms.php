<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Student Form</title>
</head>
<body>
    <h2>Create a New Student</h2>
    <form action="/CRUD/Students/CreateStudent.php" method="post">
        <label for="student_name">Student Name:</label>
        <input type="text" name="student_name" required />
        <label for="email">Email:</label>
        <input type="email" name="email" required />

        <input type="submit" value="Create Student" /><br /><br />
        <h2>Select Courses</h2>
        <?php
        include_once 'Database/Data.php';
        $conn = connectToDatabase();
        $sql = "SELECT * FROM courses";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) 
            {
                echo '<label> Courses Name: ' . $row['course_name'] . ' - $' . $row['Cost'] . ' per class:</label>';
                echo '<input type="number" name="courses[' . $row['course_id'] . '][num_classes]" min="0"><br>';
                echo '</div>';
            }
        } 
        else
        {
            echo "No courses available";
        }
        $conn->close();
        ?>

    </form>
</body>
</html>
