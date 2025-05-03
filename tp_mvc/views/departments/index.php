<?php 
$pageTitle = 'Department Management';
$activeNav = 'department';
include 'views/layouts/header.php'; 
?>

<h2>Departments</h2>
<div class="mb-3">
    <a href="index.php?controller=department&action=create" class="btn btn-primary">Add New Department</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <a href="index.php?controller=department&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="index.php?controller=department&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this department?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">No departments found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include 'views/layouts/footer.php'; ?>