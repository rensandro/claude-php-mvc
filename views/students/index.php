<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>
<body>
    <h1>Students</h1>
    <a href="index.php?action=create">Add New Student</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <?php if($row['photo']): ?>
                    <img src="uploads/<?php echo $row['photo']; ?>" width="50" height="50">
                <?php endif; ?>
            </td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="index.php?action=view&id=<?php echo $row['id']; ?>">View</a>
                <a href="index.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>
                <a href="index.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
