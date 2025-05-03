<?php 
$pageTitle = 'Student Management';
$activeNav = 'student';
include 'views/layouts/header.php'; 
?>

<h2>Students</h2>
<div class="mb-3">
    <a href="index.php?controller=student&action=create" class="btn btn-primary">Add New Student</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>NIM</th>
            <th>Phone</th>
            <th>Join Date</th>
            <th>Email</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['nim']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['join_date']; ?></td>
                    <td><?php echo $row['email'] ?? ''; ?></td>
                    <td><?php echo $row['department_name'] ?? 'N/A'; ?></td>
                    <td>
                        <a href="index.php?controller=student&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="index.php?controller=student&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="text-center">No students found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include 'views/layouts/footer.php'; ?>