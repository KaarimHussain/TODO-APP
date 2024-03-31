<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addTask'])) {
        include "./config/db.php";
        include "./config/session.php";

        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $userID = $_SESSION['logged']['id'];

        $sql = "INSERT INTO tasks (user_id, title, description, category, created_at) VALUES (?,?,?,?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $userID, $title, $description, $category);
        if ($stmt->execute()) {
            $_SESSION['addingTaskInfo'] = "Task Added successfully";
            header("Location: AddTask.php");
            exit();
        } else {
            $_SESSION['addingTaskInfo'] = "Task Cannot be Added. Please try again ";
            header("Location: AddTask.php");
            exit();
        }
        $stmt->close();
        $conn->close();
    } else {
        header("Location: AddTask.php");
        exit();
    }
} else {
    header("Location: AddTask.php");
    exit();
}
