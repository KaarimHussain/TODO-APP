<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['editTask'])) {
        include "./config/db.php";
        include "./config/session.php";
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];

        $sql = "UPDATE tasks SET title = ?, description = ?, category = ?, created_at = NOW() WHERE id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $title, $description, $category);
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
