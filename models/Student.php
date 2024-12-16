<?php
class Student {
    private $conn;
    private $table_name = 'students';

    public $id;
    public $name;
    public $email;
    public $photo;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET name=:name, email=:email, photo=:photo, created_at=:created_at";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->photo = htmlspecialchars(strip_tags($this->photo));
        $this->created_at = date('Y-m-d H:i:s');

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":photo", $this->photo);
        $stmt->bindParam(":created_at", $this->created_at);

        return $stmt->execute() ? true : false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->photo = $row['photo'];
        $this->created_at = $row['created_at'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET 
                    name = :name,
                    email = :email,
                    " . ($this->photo ? "photo = :photo," : "") . "
                    created_at = :created_at
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":created_at", $this->created_at);

        if ($this->photo) {
            $this->photo = htmlspecialchars(strip_tags($this->photo));
            $stmt->bindParam(":photo", $this->photo);
        }

        return $stmt->execute() ? true : false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        return $stmt->execute() ? true : false;
    }
}