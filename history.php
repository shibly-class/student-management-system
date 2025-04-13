<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = '';
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT studentID, courseCode, courseTitle, semester FROM courses WHERE studentID LIKE '%$search%'";
} else {
    $sql = "SELECT studentID, courseCode, courseTitle, semester FROM courses";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
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

        .search-container {
            margin-top: 80px;
            margin-bottom: 20px;
            text-align: center;
        }

        .search-container input[type="text"] {
            padding: 8px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 70%;
        }

        .search-container button {
            padding: 8px 12px;
            margin-left: 8px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #555;
        }

        .content {
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

    <div class="search-container">
        <form method="GET">
            <input type="text" name="search" placeholder="Search by Student ID" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
            <a href="history.php"><button type="button">Clear Search</button></a>
        </form>
    </div>

    <div class="content">
        <div class="heading">
            <h1>Enrollment History</h1>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Semester</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['studentID']}</td>
                                <td>{$row['courseCode']}</td>
                                <td>{$row['courseTitle']}</td>
                                <td>{$row['semester']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data available</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>
</html>
