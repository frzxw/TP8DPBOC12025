<?php
require_once 'models/Department.php';

class DepartmentController {
    private $department;

    public function __construct() {
        $this->department = new Department();
    }

    // Display all departments
    public function index() {
        $result = $this->department->getAll();
        include 'views/departments/index.php';
    }

    // Display department create form
    public function create() {
        include 'views/departments/create.php';
    }

    // Save new department
    public function store() {
        if(isset($_POST['submit'])) {
            $this->department->name = $_POST['name'];

            $result = $this->department->create();
            if($result === true) {
                header("Location: index.php?controller=department&action=index");
            } else {
                echo "Department could not be created: " . $result;
            }
        }
    }

    // Display department for editing
    public function edit() {
        if(isset($_GET['id'])) {
            $this->department->id = $_GET['id'];
            $this->department->getOne();
            include 'views/departments/edit.php';
        }
    }

    // Update department
    public function update() {
        if(isset($_POST['submit'])) {
            $this->department->id = $_POST['id'];
            $this->department->name = $_POST['name'];

            $result = $this->department->update();
            if($result === true) {
                header("Location: index.php?controller=department&action=index");
            } else {
                echo "Department could not be updated: " . $result;
            }
        }
    }

    // Delete department
    public function delete() {
        if(isset($_GET['id'])) {
            $this->department->id = $_GET['id'];
            $result = $this->department->delete();
            if($result === true) {
                header("Location: index.php?controller=department&action=index");
            } else {
                echo "Department could not be deleted: " . $result;
            }
        }
    }
}
?>