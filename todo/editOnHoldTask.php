<?php
include "config/session.php";
if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
    exit();
}
if (!isset($_POST['editOnHold'])) {
    header("Location: viewAllTask.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changing On Hold Task | Todo - Kaarim Hussain</title>
    <?php
    include "./config/fonts.php";
    include "./config/icons.php";
    include "./config/bootstrap.php";
    ?>
    <link rel="stylesheet" href="./styles/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./styles/onHold.css?v=<?php echo time(); ?>">
</head>

<body>
    <section>
        <a href="viewAllTask.php" class="goBackLink text-dark text-decoration-none fs-2"><i class="bi bi-arrow-counterclockwise"></i> Go Back</a>

        <div class="errorContainer mt-5">
            <?php
            if (isset($_SESSION['OnHoldTaskInfo'])) {
                echo '
                <div class="alert alert-danger" data-bs-theme="light" role="alert">
                    ' . $_SESSION['OnHoldTaskInfo'] . '
                </div>
                ';
                unset($_SESSION['OnHoldTaskInfo']);
            }
            ?>
        </div>
        <h1 class="text-center pb-5">Edit On Hold Task</h1>
        <form action="processEditOnHold.php" method="post" class="d-flex flex-column justify-content-center align-items-center gap-2">
            <input type="hidden" name="taskID" value="<?php echo $_POST['taskId']; ?>">
            <select name="option" id="option">
                <option value="Important">Important</option>
                <option value="Main">Main</option>
                <option value="Urgent">Urgent</option>
                <option value="Work">Work</option>
            </select>
            <button type="submit" name="editOnHoldTask" class="btn customBtn rounded-pill col-2">
                Edit Task
            </button>
        </form>
        <br><br><br>
        <small class="text-center"><i>Selecting any one of the options will change your task category</i></small>
    </section>
</body>

</html>