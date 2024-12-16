<!DOCTYPE html>
<html>
<head>
    <title>View Student</title>
</head>
<body>
    <h1>Student Details</h1>
    <p>Name: <?php echo $this->student->name; ?></p>
    <p>Email: <?php echo $this->student->email; ?></p>
    <p>Photo: 
        <?php if($this->student->photo): ?>
            <img src="uploads/<?php echo $this->student->photo; ?>" width="200" height="200">
        <?php else: ?>
            No photo
        <?php endif; ?>
    </p>
    <p>Created At: <?php echo $this->student->created_at; ?></p>
    <a href="index.php?action=index">Back to List</a>
</body>
</html>