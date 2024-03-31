<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        include "./config/db.php";
        include "./config/session.php";
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['logged'] = array(
                    "username" => $row['username'],
                    "email" => $email,
                    "id" => $row['id']
                );
                header("Location: dashboard.php");
                exit();
            } else {
                $_SESSION['errorLogin'] = "Invalid Email or Password";
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['errorLogin'] = "No User Found";
            header("Location: index.php");
            exit();
        }
        $stmt->close();
        $conn->close();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
