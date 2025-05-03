<?php 
$pageTitle = 'Edit Course';
$activeNav = 'course';
include 'views/layouts/header.php'; 
?>

<h2>Edit Course</h2>
<a href="index.php?controller=course&action=index" class="btn btn-secondary mb-3">Back to List</a>

<div class="card">
    <div class="card-body">
        <form action="index.php?controller=course&action=update" method="POST">
            <input type="hidden" name="id" value="<?php echo $this->course->id; ?>">
            <div class="mb-3">
                <label for="course_code" class="form-label">Course Code</label>
                <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo $this->course->course_code; ?>" required>
            </div>
            <div class="mb-3">
                <label for="course_name" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo $this->course->course_name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="credits" class="form-label">Credits</label>
                <input type="number" class="form-control" id="credits" name="credits" value="<?php echo $this->course->credits; ?>" required>
            </div>
            <div class="mb-3">
                <label for="department_id" class="form-label">Department</label>
                <select class="form-select" id="department_id" name="department_id" required>
                    <option value="">Select Department</option>
                    <?php while($dept = $departments->fetch_assoc()): ?>
                        <option value="<?php echo $dept['id']; ?>" <?php echo ($dept['id'] == $this->course->department_id) ? 'selected' : ''; ?>>
                            <?php echo $dept['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo $this->course->description; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>