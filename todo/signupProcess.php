<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Signup'])) {
        include "./config/db.php";
        include "./config/session.php";
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql1 = "SELECT * FROM users WHERE email = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("s", $email);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if ($result1->num_rows > 0) {
            $_SESSION['errorSignup'] = "Email already registered please try new one";
            header("Location: signup.php");
            exit();
        } else {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql2 = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("sss", $username, $email, $hashPassword);
            $stmt2->execute();

            $id = $stmt2->insert_id;
            $_SESSION['logged'] = array(
                'username' => $username,
                'email' => $email,
                'id' => $id
            );
            header("Location: dashboard.php");
            exit();
        }
        $conn->close();
        $stmt1->close();
        $stmt2->close();
    } else {
        header("Location: signup.php");
        exit();
    }
} else {
    header("Location: signup.php");
    exit();
}
