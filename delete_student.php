<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];

    $sql = "DELETE FROM students WHERE studentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentID);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Student deleted successfully.');</script>";
    } else {
        echo "<script>alert('Student not found.');</script>";
    }
    $stmt->close();
}

$conn->close();
echo "<script>window.location.href='students.php';</script>";
?>
