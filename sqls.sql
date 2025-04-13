CREATE DATABASE SMS;
USE SMS;
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    studentID VARCHAR(20),
    department VARCHAR(50),
    major VARCHAR(50),
    dob DATE,
    address TEXT
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    studentID VARCHAR(20) not NULL,
    courseCode VARCHAR(20) not NULL,
    courseTitle VARCHAR(50),
    semester VARCHAR(50)
);
