<?php
include "config/db.php";
$keyword = $_POST['keyword'] ?? '';
if (!empty($keyword)) {
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE title LIKE ? AND completed = 0");
    $searchKeyword = '%' . $keyword . '%';
    $stmt->bind_param("s", $searchKeyword);
} else {
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE completed = 0");
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <div class="col-4">
            <div class="TaskMainBox">
                <header>
                    <?php echo $row['title']; ?>
                </header>
                <div class="TaskBody">
                    <?php echo $row['description']; ?>
                </div>
                <div class="footer">
                    <form method="post" action="deleteTask.php" class="col text-center">
                        <input type="hidden" name="taskId" value="<?php echo $row['id']; ?>">
                        <button name="deleteTask" class="text-center btn customBtn w-100 rounded-0" type="submit">
                            DELETE
                        </button>
                    </form>
                    <form method="post" action="completeTask.php" class="col text-center">
                        <input type="hidden" name="taskId" value="<?php echo $row['id']; ?>">
                        <button name="completeTask" class="text-center btn customBtn w-100 rounded-0" type="submit">
                            COMPLETE
                        </button>
                    </form>
                    <form method="post" action="editTask.php" class="col text-center">
                        <input type="hidden" name="taskId" value="<?php echo $row['id']; ?>">
                        <button name="editTask" class="text-center btn customBtn w-100 rounded-0" type="submit">
                            EDIT
                        </button>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "<div class='TaskMainBox'>
            <div class='TaskBody rounded-3'>
                No Task Found
            </div>
        </div>";
}

$stmt->close();
$conn->close();
?>