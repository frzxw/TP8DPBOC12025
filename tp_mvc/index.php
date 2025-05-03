<?php
// Error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include controller files
require_once 'controllers/StudentController.php';
require_once 'controllers/DepartmentController.php';
require_once 'controllers/CourseController.php';

// Determine which controller and action to use
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'student';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Instantiate the appropriate controller
try {
    switch($controller) {
        case 'student':
            $controller = new StudentController();
            break;
        case 'department':
            $controller = new DepartmentController();
            break;
        case 'course':
            $controller = new CourseController();
            break;
        default:
            $controller = new StudentController();
    }

    // Call the appropriate action
    if(method_exists($controller, $action)) {
        $controller->$action();
    } else {
        // Default to index if action doesn't exist
        $controller->index();
    }
} catch (Exception $e) {
    echo '<div class="alert alert-danger">';
    echo 'Error: ' . $e->getMessage();
    echo '</div>';
}
?>