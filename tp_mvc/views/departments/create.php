<?php 
$pageTitle = 'Add New Department';
$activeNav = 'department';
include 'views/layouts/header.php'; 
?>

<h2>Add New Department</h2>
<a href="index.php?controller=department&action=index" class="btn btn-secondary mb-3">Back to List</a>

<div class="card">
    <div class="card-body">
        <form action="index.php?controller=department&action=store" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Department Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>