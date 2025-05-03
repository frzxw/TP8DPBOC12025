<?php
require_once 'config/database.php';

class Student {
    // Database connection
    private $conn;
    // Table properties
    private $table_name = "students";
    // Object properties
    public $id;
    public $name;
    public $nim;
    public $phone;
    public $join_date;
    public $email;
    public $address;
    public $department_id;

    // Constructor
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // READ all students
    public function getAll() {
        $query = "SELECT s.*, d.name as department_name 
                 FROM " . $this->table_name . " s 
                 LEFT JOIN departments d ON s.department_id = d.id
                 ORDER BY s.id";
        $result = $this->conn->query($query);
        return $result;
    }

    // READ single student
    public function getOne() {
        $query = "SELECT s.*, d.name as department_name 
                 FROM " . $this->table_name . " s 
                 LEFT JOIN departments d ON s.department_id = d.id
                 WHERE s.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if($row) {
            $this->name = $row['name'];
            $this->nim = $row['nim'];
            $this->phone = $row['phone'];
            $this->join_date = $row['join_date'];
            $this->email = $row['email'];
            $this->address = $row['address'];
            $this->department_id = $row['department_id'];
            return true;
        }
        return false;
    }

    // CREATE student
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                (name, nim, phone, join_date, email, address, department_id)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        
        if($stmt === false) {
            return "Error preparing statement: " . $this->conn->error;
        }
        
        // Sanitize inputs
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->nim = htmlspecialchars(strip_tags($this->nim));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->join_date = htmlspecialchars(strip_tags($this->join_date));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->address = htmlspecialchars(strip_tags($this->address));
        
        // Convert empty strings to null for optional fields
        $this->phone = empty($this->phone) ? null : $this->phone;
        $this->join_date = empty($this->join_date) ? null : $this->join_date;
        $this->email = empty($this->email) ? null : $this->email;
        $this->address = empty($this->address) ? null : $this->address;
        
        // Bind parameters - note that department_id is an integer (i)
        $stmt->bind_param("ssssssi", 
            $this->name, 
            $this->nim, 
            $this->phone, 
            $this->join_date, 
            $this->email, 
            $this->address, 
            $this->department_id
        );
        
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        
        // Return the error message if there's an error
        return "Error: " . $stmt->error;
    }

    // UPDATE student
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                SET name = ?, nim = ?, phone = ?, join_date = ?, email = ?, address = ?, department_id = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        if($stmt === false) {
            return "Error preparing statement: " . $this->conn->error;
        }
        
        // Sanitize inputs
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->nim = htmlspecialchars(strip_tags($this->nim));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->join_date = htmlspecialchars(strip_tags($this->join_date));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->address = htmlspecialchars(strip_tags($this->address));
        
        // Convert empty strings to null for optional fields
        $this->phone = empty($this->phone) ? null : $this->phone;
        $this->join_date = empty($this->join_date) ? null : $this->join_date;
        $this->email = empty($this->email) ? null : $this->email;
        $this->address = empty($this->address) ? null : $this->address;
        
        // Bind parameters - Fixed parameter types for department_id and id (both integers)
        $stmt->bind_param("ssssssii", 
            $this->name, 
            $this->nim, 
            $this->phone, 
            $this->join_date, 
            $this->email, 
            $this->address,
            $this->department_id,
            $this->id
        );
        
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        
        // Return the error message if there's an error
        return "Error: " . $stmt->error;
    }

    // DELETE student
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