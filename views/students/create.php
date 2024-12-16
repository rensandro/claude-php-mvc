<!DOCTYPE html>
<html>
<head>
    <title>Create Student</title>
</head>
<body>
    <h1>Create Student</h1>
    <form action="index.php?action=create" method="post" enctype="multipart/form-data">
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Photo: <input type="file" name="photo" accept="image/*"></label><br>
        <input type="submit" value="Create">
    </form>
    <a href="index.php?action=index">Back to List</a>
</body>
</html>
