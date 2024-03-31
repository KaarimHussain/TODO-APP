<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['editTask'])) {
        $id = $_POST['taskId'];
        include "./config/db.php";
        include "./config/session.php";

        $sql = "SELECT * FROM tasks WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Task | Todo - Kaarim Hussain</title>
            <?php
            include "./config/fonts.php";
            include "./config/icons.php";
            include "./config/bootstrap.php";
            ?>
            <link rel="stylesheet" href="./styles/root.css?v=<?php echo time(); ?>">
            <link rel="stylesheet" href="./styles/addTask.css?v=<?php echo time(); ?>">
            <link rel="stylesheet" href="./styles/editTask.css?v=<?php echo time(); ?>">
        </head>

        <body>
            <section>
                <a href="viewAllTask.php" class="goBackLink"><i class="bi bi-arrow-counterclockwise"></i> Go Back</a>
                <h1 class="text-center fw-light">Edit Task</h1>
                <form action="processEditTask.php" method="post" class="d-flex flex-column align-items-center gap-2">
                    <div class="d-flex flex-column col-12 align-items-center gap-2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <label for="title">Enter Your Title</label>
                        <input required placeholder="Title..." value="<?php echo $row['title']; ?>" type="text" name="title" class="col-12 col-md-6 rounded-pill border-0" id="title">
                    </div>
                    <div class="d-flex flex-column col-12 align-items-center gap-2">
                        <label for="description">Enter your Task</label>
                        <textarea required name="description" placeholder="Task..." id="description" rows="5" class="rounded-3 col-6"><?php echo $row['description']; ?></textarea>
                    </div>
                    <select required name="category" id="category" class="col-6 rounded-pill">
                        <option selected disabled value="<?php echo $row['category'] ?>"><?php echo $row['category'] ?></option>
                        <option value="Main">Main</option>
                        <option value="Important">Important</option>
                        <option value="Urgent">Urgent</option>
                        <option value="Work">Work</option>
                        <option value="On Hold">On Hold</option>
                    </select>
                    <button type="submit" name="editTask" class="btn submitBtn col-6 rounded-pill">Edit Task</button>
                </form>
            </section>
        </body>

        </html>

<?php
        $stmt->close();
        $conn->close();
    } else {
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}
