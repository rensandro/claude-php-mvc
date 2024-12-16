<?php
class StudentController {
    private $db;
    private $student;

    public function __construct() {
        require_once 'config/database.php';
        require_once 'models/Student.php';
        
        $database = new Database();
        $this->db = $database->getConnection();
        $this->student = new Student($this->db);
    }

    public function index() {
        $stmt = $this->student->read();
        require 'views/students/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle photo upload
            $photo = $this->uploadPhoto();

            $this->student->name = $_POST['name'];
            $this->student->email = $_POST['email'];
            $this->student->photo = $photo;

            if ($this->student->create()) {
                header("Location: index.php?action=index");
            } else {
                echo "Unable to create student.";
            }
        } else {
            require 'views/students/create.php';
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->student->id = $_POST['id'];
            $this->student->name = $_POST['name'];
            $this->student->email = $_POST['email'];

            // Handle photo upload
            if (!empty($_FILES['photo']['name'])) {
                $photo = $this->uploadPhoto();
                $this->student->photo = $photo;
            }

            if ($this->student->update()) {
                header("Location: index.php?action=index");
            } else {
                echo "Unable to update student.";
            }
        } else {
            $this->student->id = $_GET['id'];
            $this->student->readOne();
            require 'views/students/edit.php';
        }
    }

    public function view() {
        $this->student->id = $_GET['id'];
        $this->student->readOne();
        require 'views/students/view.php';
    }

    public function delete() {
        $this->student->id = $_GET['id'];
        
        // Delete existing photo if exists
        $this->student->readOne();
        if ($this->student->photo && file_exists('uploads/' . $this->student->photo)) {
            unlink('uploads/' . $this->student->photo);
        }

        if ($this->student->delete()) {
            header("Location: index.php?action=index");
        } else {
            echo "Unable to delete student.";
        }
    }

    private function uploadPhoto() {
        $target_dir = "uploads/";
        $filename = uniqid() . '_' . basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . $filename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["photo"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if(!in_array($imageFileType, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Upload file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                return $filename;
            } else {
                echo "Sorry, there was an error uploading your file.";
                return null;
            }
        }

        return null;
    }
}