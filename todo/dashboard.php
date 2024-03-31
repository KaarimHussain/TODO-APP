<?php
include "./config/session.php";
if (!isset($_SESSION['logged'])) {
    header("Location:./index.php");
    exit();
}
include "./config/db.php";
$name = $_SESSION['logged']['username'];
$email = $_SESSION['logged']['email'];
$id = $_SESSION['logged']['id'];

// Total Task Completed Count from database

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Todo - Kaarim Hussain</title>
    <?php
    include "./config/fonts.php";
    include "./config/icons.php";
    include "./config/bootstrap.php";
    ?>
    <link rel="stylesheet" href="./styles/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./styles/dashboard.css?v=<?php echo time(); ?>">
</head>

<body>
    <main>
        <nav class="sidebar">
            <a href="viewAllTask.php" class="d-flex flex-column align-items-center text-white text-decoration-none">
                <i class="bi bi-list-check fs-2"></i>
                <small class="fw-semibold text-center d-inline">View All</small>
            </a>
            <hr class="text-white">
            <a href="AddTask.php" class="d-flex flex-column align-items-center text-white text-decoration-none">
                <i class="bi bi-plus-circle-fill fs-2"></i>
                <small class="fw-semibold text-center d-inline">Add Task</small>
            </a>
            <hr class="text-white">
            <a href="HistoryTask.php" class="d-flex flex-column align-items-center text-white text-decoration-none">
                <i class="bi bi-clock-history fs-2"></i>
                <small class="fw-semibold text-center d-inline">History</small>
            </a>
            <hr class="text-white">
            <a href="logout.php" class="d-flex flex-column align-items-center text-white text-decoration-none">
                <i class="bi bi-door-open-fill fs-2"></i>
                <small class="fw-semibold text-center d-inline">Logout</small>
            </a>
            <hr class="text-white">
        </nav>
        <section class="p-4 container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="gridBox2">
                                <h3>Welcome, <span class="fw-bold"><?php echo $name; ?></span></h3>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                            <div class="gridBox">
                                <?php
                                $sql1 = "SELECT COUNT(completed) FROM tasks WHERE completed = TRUE AND user_id = $id";
                                $stmt1 = $conn->prepare($sql1);
                                $stmt1->execute();
                                $result1 = $stmt1->get_result();
                                if ($result1->num_rows > 0) {
                                    $row1 = $result1->fetch_assoc();
                                    echo "Total Completed Task " . " <h3 class='fw-bolder'>" . $row1['COUNT(completed)'] . "</h3>";
                                } else {
                                    echo  "Total Completed Task <br>" . "<h3 class='fw-bolder'>0</h3>";
                                }
                                $stmt1->close();
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                            <div class="gridBox">
                                <?php
                                $sql2 = "SELECT COUNT(category) FROM tasks WHERE category = 'On Hold' AND user_id = $id";
                                $stmt2 = $conn->prepare($sql2);
                                $stmt2->execute();
                                $result2 = $stmt2->get_result();
                                if ($result2->num_rows > 0) {
                                    $row2 = $result2->fetch_assoc();
                                    echo "Task On Hold " . " <h3 class='fw-bolder'>" . $row2['COUNT(category)'] . "</h3>";
                                } else {
                                    echo  "Task On Hold <br>" . "<h3 class='fw-bolder'>0</h3>";
                                }
                                $stmt2->close();
                                ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="gridBox">
                                <?php
                                $sql3 = "SELECT COUNT(id) FROM tasks WHERE user_id = ? AND completed = 0";
                                $stmt3 = $conn->prepare($sql3);
                                $stmt3->bind_param("s", $id);
                                $stmt3->execute();
                                $result3 = $stmt3->get_result();
                                if ($result3->num_rows > 0) {
                                    $row3 = $result3->fetch_assoc();
                                    echo "Uncompleted Task " . " <h3 class='fw-bolder'>" . $row3['COUNT(id)'] . "</h3>";
                                } else {
                                    echo  "Total Task Assigned <br>" . "<h3 class='fw-bolder'>0</h3>";
                                }
                                $stmt3->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="recentTaskBox">
                        <div class="p-3 taskBoxHeading ">
                            <p class="fw-light fs-5">All Task</p>
                            <div class="d-flex flex-column gap-1">
                                <small class="text-secondary"><i class="bi bi-x"></i> Not Completed</small>
                                <small class="text-secondary"><i class="bi bi-check2"></i> Completed</small>
                            </div>
                        </div>
                        <div class="taskBoxMain">
                            <ul>
                                <?php
                                $sql = "SELECT * FROM tasks WHERE user_id = ? AND category IN ('Important', 'Main', 'Urgent', 'Work') LIMIT 7";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <li class='d-flex justify-content-between w-100'>
                                            <p title="<?php echo $row['title'] ?>" class="taskTitle fs-5 mt-3 fw-light"><?php echo $row['title'] ?></p>
                                            <div class="d-flex gap-2 align-items-center">
                                                <?php
                                                if ($row['completed'] == 0) {
                                                    echo '<small class="urgent rounded-pill"><i class="bi bi-x"></i></small>';
                                                } else {
                                                    echo '<small class="completed rounded-pill"><i class="bi bi-check2"></i></small>';
                                                }
                                                ?>
                                                <small class="
                                            <?php
                                            if ($row['category'] == "Completed") {
                                                echo "completed";
                                            } else if ($row['category'] == "Urgent") {
                                                echo "urgent";
                                            } else if ($row['category'] == "Main") {
                                                echo "main";
                                            } else if ($row['category'] == "On Hold") {
                                                echo "onHold";
                                            } else if ($row['category'] == "Important") {
                                                echo "important";
                                            }
                                            ?> rounded-pill">
                                                    <?php echo $row['category'] ?>
                                                </small>
                                            </div>

                                        </li>
                                        <hr>
                                <?php
                                    }
                                } else {
                                    print_r("<li>No Recent Task Found</li>");
                                }

                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php
    $stmt->close();
    $conn->close();
    ?>
</body>

</html>