-- Create database
CREATE DATABASE tp8dpboc12025;
USE tp8dpboc12025;

-- Create departments table
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Create students table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nim VARCHAR(50) NOT NULL,
    phone VARCHAR(15),
    join_date DATE,
    email VARCHAR(100),
    address TEXT,
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

-- Create courses table
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(50) NOT NULL,
    course_name VARCHAR(100) NOT NULL,
    credits INT NOT NULL,
    department_id INT,
    description TEXT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

-- Insert dummy data into departments table
INSERT INTO departments (name) VALUES
('Computer Science'),
('Mathematics'),
('Physics'),
('Chemistry');

-- Insert dummy data into students table
INSERT INTO students (name, nim, phone, join_date, email, address, department_id) VALUES
('Alice Johnson', 'CS2023001', '1234567890', '2023-01-15', 'alice.johnson@example.com', '123 Main St', 1),
('Bob Smith', 'CS2023002', '0987654321', '2023-01-16', 'bob.smith@example.com', '456 Elm St', 1),
('Charlie Brown', 'MATH2023001', '1122334455', '2023-01-17', 'charlie.brown@example.com', '789 Oak St', 2);

-- Insert dummy data into courses table
INSERT INTO courses (course_code, course_name, credits, department_id, description) VALUES
('CS101', 'Introduction to Programming', 3, 1, 'Basic programming concepts'),
('CS102', 'Data Structures', 4, 1, 'Introduction to data structures'),
('MATH101', 'Calculus I', 3, 2, 'Differential and integral calculus'),
('PHYS101', 'General Physics', 4, 3, 'Fundamentals of physics');