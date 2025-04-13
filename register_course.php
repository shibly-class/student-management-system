<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_POST['student_id'] ?? null;
$course_code = $_POST['course_code'] ?? null;
$course_title = $_POST['course_title'] ?? null;
$semester = $_POST['semester'] ?? null;

$sql = "INSERT INTO courses (studentID, courseCode, courseTitle, semester)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $student_id, $course_code, $course_title, $semester);

if ($stmt->execute()) {
    echo "Course registration successful.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: students.php");
exit();
?>
