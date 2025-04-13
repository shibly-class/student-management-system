<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
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
            margin-top: 60px;
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

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
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
            <h1>Student Registration</h1>
            <form action="register.php" method="POST">
                <label for="name">Name <span style="color: red;">*</span></label>
                <input type="text" id="name" name="name" required>
                <div class="error" id="name-error"></div>

                <label for="email">Email <span style="color: red;">*</span></label>
                <input type="email" id="email" name="email" required>
                <?php if (isset($_GET['email_error'])): ?>
                    <div class="error">This email is already registered. Please use a different email.</div>
                <?php endif; ?>


                <label for="student_id">Student ID</label>
                <input type="text" id="student_id" name="student_id">

                <label for="department">Department</label>
                <select id="department" name="department">
                    <option value="">Select Department</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Physics">Physics</option>
                </select>

                <label for="major">Major</label>
                <select id="major" name="major">
                    <option value="">Select Major</option>
                    <option value="Software Engineering">Software Engineering</option>
                    <option value="Data Science">Data Science</option>
                    <option value="Cybersecurity">Cybersecurity</option>
                </select>

                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob">

                <label for="address">Address</label>
                <textarea id="address" name="address"></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            let valid = true;

            document.getElementById("name-error").textContent = "";
            document.getElementById("email-error").textContent = "";

            const nameField = document.getElementById("name");
            if (!nameField.value.trim()) {
                document.getElementById("name-error").textContent = "Name is required.";
                valid = false;
            }

            const emailField = document.getElementById("email");
            if (!emailField.value.trim()) {
                document.getElementById("email-error").textContent = "Email is required.";
                valid = false;
            }

            if (!valid) {
                event.preventDefault();
            }
        });
    </script>

</body>
</html>
