<?php 
$pageTitle = 'Add New Student';
$activeNav = 'student';
include 'views/layouts/header.php'; 
?>

<h2>Add New Student</h2>
<a href="index.php?controller=student&action=index" class="btn btn-secondary mb-3">Back to List</a>

<div class="card">
    <div class="card-body">
        <form action="index.php?controller=student&action=store" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="mb-3">
                <label for="join_date" class="form-label">Join Date</label>
                <input type="date" class="form-control" id="join_date" name="join_date">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="department_id" class="form-label">Department</label>
                <select class="form-select" id="department_id" name="department_id" required>
                    <option value="">Select Department</option>
                    <?php while($dept = $departments->fetch_assoc()): ?>
                        <option value="<?php echo $dept['id']; ?>"><?php echo $dept['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>