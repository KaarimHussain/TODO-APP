<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['completeTask'])) {
        include "./config/db.php";
        include "./config/session.php";
        $id = $_POST['taskId'];
        $sql = "UPDATE tasks SET completed = TRUE, created_at = NOW() WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            header("Location: viewAllTask.php");
            exit();
        } else {
            header("Lcat: viewAllTask.php");
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
