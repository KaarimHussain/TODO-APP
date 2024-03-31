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
    <title>Login | Todo - Kaarim Hussain</title>
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
            if (isset($_SESSION['errorLogin'])) {
                echo '
                <div class="alert alert-danger" data-bs-theme="light" role="alert">
                    ' . $_SESSION['errorLogin'] . '
                </div>
                ';
                unset($_SESSION['errorLogin']);
            }
            ?>
        </div>
    </div>
    <div id="main" class="container d-flex justify-content-center align-items-center">
        <form action="loginProcess.php" method="post">
            <h1 class="text-center fw-bold fs-3">LOGIN</h1>
            <div class="mt-2 mb-2 col-12 d-flex flex-column gap-2">
                <label for="email">Email</label>
                <input type="email" autocomplete="off" placeholder="Email..." name="email" class="inputs">
            </div>
            <div class="mt-2 mb-2 col-12 d-flex flex-column gap-2">
                <label for="password">Password</label>
                <input type="password" autocomplete="off" placeholder="Password..." name="password" class="inputs">
            </div>
            <div class="col-12 mt-3 mb-4">
                <button type="submit" name="login" class="btn col-12" id="actionBtn">Login</button>
            </div>
            <div class="col-12 text-end mt-1 mb-1">
                <small class='forgotlink'>Forgot Password?<a href="#" class="text-decoration-none"> Here</a></small>
            </div>
            <div class="col-12 text-end mt-1">
                <small class="forgotlink">Don't have an account? <a href="signup.php" class="text-decoration-none"> Signup</a></small>
            </div>
        </form>
    </div>
</body>

</html>