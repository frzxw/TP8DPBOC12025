<?php 
$pageTitle = 'Edit Department';
$activeNav = 'department';
include 'views/layouts/header.php'; 
?>

<h2>Edit Department</h2>
<a href="index.php?controller=department&action=index" class="btn btn-secondary mb-3">Back to List</a>

<div class="card">
    <div class="card-body">
        <form action="index.php?controller=department&action=update" method="POST">
            <input type="hidden" name="id" value="<?php echo $this->department->id; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Department Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->department->name; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>