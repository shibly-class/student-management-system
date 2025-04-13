<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 1.5em;
            font-weight: bold;
        }

        .navbar .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding-right: 50px;
        }

        .navbar .nav-links li {
            display: inline;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 1em;
            transition: color 0.3s ease;
        }

        .navbar .nav-links a:hover {
            color: #ddd;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 40%;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: black;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$studentID = $_GET['studentID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $major = $_POST['major'];
    $email = $_POST['email'];

    $sql = "UPDATE students SET name=?, department=?, major=?, email=? WHERE studentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $department, $major, $email, $studentID);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Student updated successfully.'); window.location.href='students.php';</script>";
    } else {
        echo "<script>alert('No changes made.');</script>";
    }
    $stmt->close();
}

$sql = "SELECT * FROM students WHERE studentID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $studentID);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<div class="navbar">
    <div class="logo">StudentManager</div>
    <ul class="nav-links">
        <li><a href="student_form.php">Add Student</a></li>
        <li><a href="students.php">Student List</a></li>
        <li><a href="course_form.php">Enroll in Course</a></li>
        <li><a href="history.php">Enrollment History</a></li>
    </ul>
</div>

<div class="content">
    <div class="form-container">
        <h2>Edit Student</h2>
        <form method="POST">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>

            <label>Department:</label>
            <input type="text" name="department" value="<?php echo htmlspecialchars($student['department']); ?>" required>

            <label>Major:</label>
            <input type="text" name="major" value="<?php echo htmlspecialchars($student['major']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>

            <button type="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>
