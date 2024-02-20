<?php
function connectToDatabase()
{
    $servername = "localhost";
    $username = "root";
    $password = "gevorg789456123";
    $dbname = "CoursesAndStudents";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}