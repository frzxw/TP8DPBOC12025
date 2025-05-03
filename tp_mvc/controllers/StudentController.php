<?php
require_once 'models/Student.php';
require_once 'models/Department.php';

class StudentController {
    private $student;
    private $department;

    public function __construct() {
        $this->student = new Student();
        $this->department = new Department();
    }

    // Display all students
    public function index() {
        $result = $this->student->getAll();
        include 'views/students/index.php';
    }

    // Display student create form
    public function create() {
        $departments = $this->department->getAll();
        include 'views/students/create.php';
    }

    // Save new student
    public function store() {
        if(isset($_POST['submit'])) {
            $this->student->name = $_POST['name'];
            $this->student->nim = $_POST['nim'];
            $this->student->phone = $_POST['phone'];
            $this->student->join_date = $_POST['join_date'];
            $this->student->email = $_POST['email'];
            $this->student->address = $_POST['address'];
            $this->student->department_id = $_POST['department_id'];

            $result = $this->student->create();
            if($result === true) {
                header("Location: index.php?controller=student&action=index");
            } else {
                echo "Student could not be created: " . $result;
            }
        }
    }

    // Display student for editing
    public function edit() {
        if(isset($_GET['id'])) {
            $this->student->id = $_GET['id'];
            $this->student->getOne();
            $departments = $this->department->getAll();
            include 'views/students/edit.php';
        }
    }

    // Update student
    public function update() {
        if(isset($_POST['submit'])) {
            $this->student->id = $_POST['id'];
            $this->student->name = $_POST['name'];
            $this->student->nim = $_POST['nim'];
            $this->student->phone = $_POST['phone'];
            $this->student->join_date = $_POST['join_date'];
            $this->student->email = $_POST['email'];
            $this->student->address = $_POST['address'];
            $this->student->department_id = $_POST['department_id'];

            $result = $this->student->update();
            if($result === true) {
                header("Location: index.php?controller=student&action=index");
            } else {
                echo "Student could not be updated: " . $result;
            }
        }
    }

    // Delete student
    public function delete() {
        if(isset($_GET['id'])) {
            $this->student->id = $_GET['id'];
            $result = $this->student->delete();
            if($result === true) {
                header("Location: index.php?controller=student&action=index");
            } else {
                echo "Student could not be deleted: " . $result;
            }
        }
    }
}
?>