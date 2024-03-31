<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['deleteTask'])) {
        include "./config/db.php";
        include "./config/session.php";
        $id = $_POST['taskId'];
        $sql = "DELETE FROM tasks WHERE id =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $_SESSION['deleteTaskInfo'] = "Task Deleted successfully";
            header("Location: viewAllTask.php");
            exit();
        } else {
            $_SESSION['deleteTaskInfo'] = "Task Failed to Delete";
            header("Location: viewAllTask.php");
            exit();
        }
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
