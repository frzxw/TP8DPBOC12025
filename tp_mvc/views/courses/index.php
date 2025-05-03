<?php 
$pageTitle = 'Course Management';
$activeNav = 'course';
include 'views/layouts/header.php'; 
?>

<h2>Courses</h2>
<div class="mb-3">
    <a href="index.php?controller=course&action=create" class="btn btn-primary">Add New Course</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Credits</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['course_code']; ?></td>
                    <td><?php echo $row['course_name']; ?></td>
                    <td><?php echo $row['credits']; ?></td>
                    <td><?php echo $row['department_name'] ?? 'N/A'; ?></td>
                    <td>
                        <a href="index.php?controller=course&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="index.php?controller=course&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">No courses found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include 'views/layouts/footer.php'; ?>