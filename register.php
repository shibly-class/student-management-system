<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$student_id = $_POST['student_id'] ?? null;
$department = $_POST['department'] ?? null;
$major = $_POST['major'] ?? null;
$dob = $_POST['dob'] ?? null;
$address = $_POST['address'] ?? null;

$email_check_query = "SELECT email FROM students WHERE email = ?";
$email_check_stmt = $conn->prepare($email_check_query);
$email_check_stmt->bind_param("s", $email);
$email_check_stmt->execute();
$email_check_result = $email_check_stmt->get_result();

if ($email_check_result->num_rows > 0) {
    header("Location: student_form.php?email_error=true");
    exit();
} else {
    $sql = "INSERT INTO students (name, email, studentID, department, major, dob, address)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $name, $email, $student_id, $department, $major, $dob, $address);

    if ($stmt->execute()) {
        echo "Student information has been registered successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$email_check_stmt->close();
$conn->close();

header("Location: students.php");
?>
