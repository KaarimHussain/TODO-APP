<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['editOnHoldTask'])) {
        include "./config/db.php";
        include "./config/session.php";
        $option = $_POST['option'];
        $task_id = $_POST['taskID'];
        $sql = "UPDATE tasks SET category = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $option, $task_id);
        if ($stmt->execute()) {
            $_SESSION['OnHoldTaskInfo'] = "Task Deleted successfully";
            header("Location: editOnHoldTask.php");
            exit();
        }else{
            $_SESSION['OnHoldTaskInfo'] = "Task Failed to Change";
            header("Location: editOnHoldTask.php");
            exit();
        }
    }
}
