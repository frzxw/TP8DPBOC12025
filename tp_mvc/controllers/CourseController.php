<?php
require_once 'models/Course.php';
require_once 'models/Department.php';

class CourseController {
    private $course;
    private $department;

    public function __construct() {
        $this->course = new Course();
        $this->department = new Department();
    }

    // Display all courses
    public function index() {
        $result = $this->course->getAll();
        include 'views/courses/index.php';
    }

    // Display course create form
    public function create() {
        $departments = $this->department->getAll();
        include 'views/courses/create.php';
    }

    // Save new course
    public function store() {
        if(isset($_POST['submit'])) {
            $this->course->course_code = $_POST['course_code'];
            $this->course->course_name = $_POST['course_name'];
            $this->course->credits = $_POST['credits'];
            $this->course->department_id = $_POST['department_id'];
            $this->course->description = $_POST['description'];

            $result = $this->course->create();
            if($result === true) {
                header("Location: index.php?controller=course&action=index");
            } else {
                echo "Course could not be created: " . $result;
            }
        }
    }

    // Display course for editing
    public function edit() {
        if(isset($_GET['id'])) {
            $this->course->id = $_GET['id'];
            $this->course->getOne();
            $departments = $this->department->getAll();
            include 'views/courses/edit.php';
        }
    }

    // Update course
    public function update() {
        if(isset($_POST['submit'])) {
            $this->course->id = $_POST['id'];
            $this->course->course_code = $_POST['course_code'];
            $this->course->course_name = $_POST['course_name'];
            $this->course->credits = $_POST['credits'];
            $this->course->department_id = $_POST['department_id'];
            $this->course->description = $_POST['description'];

            $result = $this->course->update();
            if($result === true) {
                header("Location: index.php?controller=course&action=index");
            } else {
                echo "Course could not be updated: " . $result;
            }
        }
    }

    // Delete course
    public function delete() {
        if(isset($_GET['id'])) {
            $this->course->id = $_GET['id'];
            $result = $this->course->delete();
            if($result === true) {
                header("Location: index.php?controller=course&action=index");
            } else {
                echo "Course could not be deleted: " . $result;
            }
        }
    }
}
?>