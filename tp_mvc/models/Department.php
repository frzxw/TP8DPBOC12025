<?php
require_once 'config/database.php';

class Department {
    // Database connection
    private $conn;
    // Table properties
    private $table_name = "departments";
    // Object properties
    public $id;
    public $name;

    // Constructor
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // READ all departments
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id";
        $result = $this->conn->query($query);
        return $result;
    }

    // READ single department
    public function getOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if($row) {
            $this->name = $row['name'];
            return true;
        }
        return false;
    }

    // CREATE department
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        
        if($stmt === false) {
            return "Error preparing statement: " . $this->conn->error;
        }
        
        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        
        // Bind parameter
        $stmt->bind_param("s", $this->name);
        
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        
        // Return the error message if there's an error
        return "Error: " . $stmt->error;
    }

    // UPDATE department
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        if($stmt === false) {
            return "Error preparing statement: " . $this->conn->error;
        }
        
        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        
        // Bind parameters
        $stmt->bind_param("si", $this->name, $this->id);
        
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        
        // Return the error message if there's an error
        return "Error: " . $stmt->error;
    }

    // DELETE department
    public function delete() {
        // Check for dependencies before delete
        $checkQueries = [
            "SELECT * FROM students WHERE department_id = ?",
            "SELECT * FROM courses WHERE department_id = ?"
        ];
        
        foreach ($checkQueries as $query) {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                return "Cannot delete department: This department is referenced by students or courses.";
            }
        }
        
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