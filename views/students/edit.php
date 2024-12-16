<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="index.php?action=edit" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $this->student->id; ?>">
        <label>Name: <input type="text" name="name" value="<?php echo $this->student->name; ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?php echo $this->student->email; ?>" required></label><br>
        <label>Current Photo: 
            <?php if($this->student->photo): ?>
                <img src="uploads/<?php echo $this->student->photo; ?>" width="100" height="100">
            <?php else: ?>
                No photo
            <?php endif; ?>
        </label><br>
        <label>Change Photo: <input type="file" name="photo" accept="image/*"></label><br>
        <input type="submit" value="Update">
    </form>
    <a href="index.php?action=index">Back to List</a>
</body>
</html>
