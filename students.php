<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT name, studentID, department, major, email FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        /* Same styling as before with button styles added */
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
            margin-top: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .heading h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 1.8em;
        }

        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 80%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .action-buttons a {
            padding: 5px 10px;
            margin: 0 3px;
            text-decoration: none;
            border-radius: 4px;
            color: white;
            font-size: 0.9em;
        }

        .edit-btn {
            background-color: #4CAF50;
        }

        .delete-btn {
            background-color: #f44336;
        }
    </style>
</head>
<body>
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
        <div class="heading">
            <h1>Student List</h1>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Department</th>
                    <th>Major</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['studentID'];
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['studentID']}</td>
                                <td>{$row['department']}</td>
                                <td>{$row['major']}</td>
                                <td>{$row['email']}</td>
                                <td class='action-buttons'>
                                    <a class='edit-btn' href='edit_student.php?studentID={$id}'>Edit</a>
                                    <a class='delete-btn' href='delete_student.php?studentID={$id}' onclick=\"return confirm('Are you sure you want to delete this student?');\">Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data available</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>
</html>
