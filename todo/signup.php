<?php
include "./config/session.php";
if (isset($_SESSION['logged'])) {
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | Todo - Kaarim Hussain</title>
    <?php
    include "./config/fonts.php";
    include "./config/icons.php";
    include "./config/bootstrap.php";
    ?>
    <link rel="stylesheet" href="./styles/root.css">
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <div class="container">
        <div class="errorContainer mt-5">
            <?php
            if (isset($_SESSION['errorSignup'])) {
                echo '
                <div class="alert alert-danger" data-bs-theme="light" role="alert">
                    ' . $_SESSION['errorSignup'] . '
                </div>
                ';
                unset($_SESSION['errorSignup']);
            }
            ?>
        </div>
    </div>
    <div id="main" class="container d-flex justify-content-center align-items-center">
        <form action="signupProcess.php" method="post">
            <h1 class="text-center fw-bold fs-3">SIGNUP</h1>
            <!-- username -->
            <div class="mt-2 mb-2 col-12 d-flex flex-column gap-2">
                <label for="username">Username</label>
                <input type="text" autocomplete="off" placeholder="Username..." name="username" class="inputs">
            </div>
            <!-- email -->
            <div class="mt-2 mb-2 col-12 d-flex flex-column gap-2">
                <label for="email">Email</label>
                <input type="email" autocomplete="off" placeholder="Email..." name="email" class="inputs">
            </div>
            <!-- password -->
            <div class="mt-2 mb-2 col-12 d-flex flex-column gap-2">
                <label for="password">Password</label>
                <input type="password" autocomplete="off" placeholder="Password..." name="password" class="inputs">
            </div>
            <!-- submit btn -->
            <div class="col-12 mt-3 mb-4">
                <button type="submit" name="Signup" class="btn col-12" id="actionBtn">Signup</button>
            </div>
            <div class="col-12 text-end mt-1">
                <small class="forgotlink">Already have an account? <a href="index.php" class="text-decoration-none"> Login</a></small>
            </div>
        </form>
    </div>
</body>

</html>