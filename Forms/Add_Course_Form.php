<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php echo"Student Files URL http://localhost:17422/Student.php "?>
    <title>Create Course</title>
</head>
<body>
    <h2>Create a New Course</h2>
    <form action="index.php" method="post" style="display: inlzine-block;">
        <input type="hidden" name="id" value="">
        <label for="name">Course Name:</label>
        <input type="text" name="course_name" required>

        <label for="Cost" style="margin-left: 10px;">Cost:</label>
        <input type="text" name="Cost" required>
        <input type="submit" value="Create Course">
    </form>
</body>
</html>











