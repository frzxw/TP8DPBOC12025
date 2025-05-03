<?php
require_once 'config/database.php';

class Course {
    // Database connection
    private $conn;
    // Table properties
    private $table_name = "courses";
    // Object properties
    public $id;
    public $course_code;
    public $course_name;
    public $credits;
    public $department_id;
    public $description;

    // Constructor
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // READ all courses
    public function getAll() {
        $query = "SELECT c.*, d.name as department_name 
                 FROM " . $this->table_name . " c 
                 LEFT JOIN departments d ON c.department_id = d.id
                 ORDER BY c.id";
        $result = $this->conn->query($query);
        return $result;
    }

    // READ single course
    public function getOne() {
        $query = "SELECT c.*, d.name as department_name 
                 FROM " . $this->table_name . " c 
                 LEFT JOIN departments d ON c.department_id = d.id
                 WHERE c.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if($row) {
            $this->course_code = $row['course_code'];
            $this->course_name = $row['course_name'];
            $this->credits = $row['credits'];
            $this->department_id = $row['department_id'];
            $this->description = $row['description'];
            return true;
        }
        return false;
    }

    // CREATE course
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                (course_code, course_name, credits, department_id, description) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        
        if($stmt === false) {
            return "Error preparing statement: " . $this->conn->error;
        }
        
        // Sanitize inputs
        $this->course_code = htmlspecialchars(strip_tags($this->course_code));
        $this->course_name = htmlspecialchars(strip_tags($this->course_name));
        // Don't sanitize numeric fields with htmlspecialchars
        $this->credits = (int)$this->credits;
        $this->description = htmlspecialchars(strip_tags($this->description));
        
        // Bind parameters
        $stmt->bind_param("ssiis", $this->course_code, $this->course_name, $this->credits, $this->department_id, $this->description);
        
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        
        // Return the error message if there's an error
        return "Error: " . $stmt->error;
    }

    // UPDATE course
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                SET course_code = ?, course_name = ?, credits = ?, department_id = ?, description = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        if($stmt === false) {
            return "Error preparing statement: " . $this->conn->error;
        }
        
        // Sanitize inputs
        $this->course_code = htmlspecialchars(strip_tags($this->course_code));
        $this->course_name = htmlspecialchars(strip_tags($this->course_name));
        // Don't sanitize numeric fields with htmlspecialchars
        $this->credits = (int)$this->credits;
        $this->description = htmlspecialchars(strip_tags($this->description));
        
        // Bind parameters
        $stmt->bind_param("ssiisi", $this->course_code, $this->course_name, $this->credits, $this->department_id, $this->description, $this->id);
        
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        
        // Return the error message if there's an error
        return "Error: " . $stmt->error;
    }

    // DELETE course
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        if($stmt === false) {
            return "Error preparing statement: " . $this->conn->error;
        }
        
        // Bind parameter
        $stmt->bind_param("i", $this->id);
        
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        
        // Return the error message if there's an error
        return "Error: " . $stmt->error;
    }
}
?>