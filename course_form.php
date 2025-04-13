<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration</title>
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
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 40%;
        }

        .form-container h1 {
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

        input, select {
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

        .form-container .error {
            color: red;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
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
        <div class="form-container">
            <h1>Course Registration</h1>
            <form action="register_course.php" method="POST">
                <label for="student_id">Student ID <span style="color: red;">*</span></label>
                <input type="text" id="student_id" name="student_id" required>
                <div class="error" id="student_id-error"></div>

                <label for="course_code">Course Code <span style="color: red;">*</span></label>
                <input type="text" id="course_code" name="course_code" required>
                <div class="error" id="course_code-error"></div>

                <label for="course_title">Course Title</label>
                <input type="text" id="course_title" name="course_title">

                <label for="semester">Semester</label>
                <select id="semester" name="semester">
                    <option value="">Select Semester</option>
                    <option value="Spring 2024">Spring 2024</option>
                    <option value="Fall 2024">Fall 2024</option>
                    <option value="Summer 2024">Summer 2024</option>
                </select>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            let valid = true;

            document.getElementById("student_id-error").textContent = "";
            document.getElementById("course_code-error").textContent = "";

            const studentIDField = document.getElementById("student_id");
            if (!studentIDField.value.trim()) {
                document.getElementById("student_id-error").textContent = "Student ID is required.";
                valid = false;
            }

            const courseCodeField = document.getElementById("course_code");
            if (!courseCodeField.value.trim()) {
                document.getElementById("course_code-error").textContent = "Course Code is required.";
                valid = false;
            }

            if (!valid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
