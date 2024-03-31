<?php
include "config/session.php";
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Task | Todo</title>
    <?php
    include "./config/fonts.php";
    include "./config/icons.php";
    include "./config/bootstrap.php";
    ?>
    <link rel="stylesheet" href="./styles/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./styles/addTask.css?v=<?php echo time(); ?>">
</head>

<body>
    <section>
        <a href="dashboard.php" class="goBackLink"><i class="bi bi-arrow-counterclockwise"></i> Go Back</a>
        <h1 class="text-center pt-5 pb-5 fw-light">Add Task</h1>
        <div class="errorContainer mt-5">
            <?php
            if (isset($_SESSION['addingTaskInfo'])) {
                echo '
                <div class="alert alert-danger" data-bs-theme="light" role="alert">
                    ' . $_SESSION['addingTaskInfo'] . '
                </div>
                ';
                unset($_SESSION['addingTaskInfo']);
            }
            ?>
        </div>
        <form action="processAddTask.php" class="d-flex flex-column align-items-center gap-3" method="post">
            <div class="d-flex flex-column col-12 align-items-center gap-2">
                <label for="title">Enter Your Title</label>
                <input required placeholder="Title..." type="text" name="title" class="col-12 col-md-6 rounded-pill border-0" id="title">
            </div>
            <div class="d-flex flex-column col-12 align-items-center gap-2">
                <label for="description">Enter your Task</label>
                <textarea required name="description" placeholder="Task..." id="description" rows="5" class="rounded-3 col-6"></textarea>
            </div>
            <select required name="category" id="category" class="col-6 rounded-pill">
                <option selected value="Main">Main</option>
                <option value="Important">Important</option>
                <option value="Urgent">Urgent</option>
                <option value="Work">Work</option>
                <option value="On Hold">On Hold</option>
            </select>
            <button type="submit" name="addTask" class="btn submitBtn col-6 rounded-pill">Add Task</button>
        </form>
    </section>
</body>

</html>