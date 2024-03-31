<?php
include "config/session.php";
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}

include "config/db.php";
$name = $_SESSION['logged']['username'];
$email = $_SESSION['logged']['email'];
$id = $_SESSION['logged']['id'];
$sql = "SELECT * FROM tasks WHERE user_id = $id AND category IN ('Important', 'Main', 'Urgent', 'Work') AND completed = 0";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Task | Todo - Kaarim Hussain</title>
    <?php
    include "./config/fonts.php";
    include "./config/icons.php";
    include "./config/bootstrap.php";
    ?>
    <link rel="stylesheet" href="./styles/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./styles/viewAllTask.css?v=<?php echo time(); ?>">
</head>

<body class="container">
    <main>
        <div class="navBox bg-white d-flex justify-content-between align-items-center p-3 rounded-3">
            <a href="dashboard.php" class="text-black text-decoration-none fw-bold fs-4"><i class="bi bi-arrow-counterclockwise"></i> Go Back</a>
            <input type="text" id="searchBar" placeholder="Search your Task..." class="col-6 rounded-pill border border-secondary">
        </div>
        <div class="container mt-5 mb-5">
            <div class="text-center mb-5">
                <h3 class="fw-light">All Task</h3>
            </div>
            <div class="row" id="resultBox">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="col-4">
                            <div class="TaskMainBox">
                                <header>
                                    <?php echo $row['title']; ?>
                                </header>
                                <div class="TaskBody">
                                    <?php echo $row['description']; ?>
                                </div>
                                <div class="footer">
                                    <form method="post" action="deleteTask.php" class="col text-center">
                                        <input type="hidden" name="taskId" value="<?php echo $row['id']; ?>">
                                        <button name="deleteTask" class="text-center btn customBtn w-100 rounded-0" type="submit">
                                            DELETE
                                        </button>
                                    </form>
                                    <form method="post" action="completeTask.php" class="col text-center">
                                        <input type="hidden" name="taskId" value="<?php echo $row['id']; ?>">
                                        <button name="completeTask" class="text-center btn customBtn w-100 rounded-0" type="submit">
                                            COMPLETE
                                        </button>
                                    </form>
                                    <form method="post" action="editTask.php" class="col text-center">
                                        <input type="hidden" name="taskId" value="<?php echo $row['id']; ?>">
                                        <button name="editTask" class="text-center btn customBtn w-100 rounded-0" type="submit">
                                            EDIT
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='TaskMainBox'>
                            <div class='TaskBody rounded-3'>
                                No Task Found
                            </div>
                        </div>";
                }
                ?>
            </div>


            <div class="text-center mt-5 mb-5">
                <h3 class="fw-light">On Hold Task</h3>
            </div>
            <div class="row">
                <?php
                $sql2 = "SELECT * FROM tasks WHERE user_id = $id AND category = 'On Hold'";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                ?>
                        <div class="col-4">
                            <div class="TaskMainBox">
                                <header>
                                    <?php echo $row2['title']; ?>
                                </header>
                                <div class="TaskBody">
                                    <?php echo $row2['description']; ?>
                                </div>
                                <div class="footer">
                                    <form method="post" action="deleteTask.php" class="col text-center">
                                        <input type="hidden" name="taskId" value="<?php echo $row2['id']; ?>">
                                        <button name="deleteTask" class="text-center btn customBtn w-100 rounded-0" type="submit">
                                            DELETE
                                        </button>
                                    </form>
                                    <form method="post" action="editOnHoldTask.php" class="col text-center">
                                        <input type="hidden" name="taskId" value="<?php echo $row2['id']; ?>">
                                        <button name="editOnHold" class="text-center btn customBtn w-100 rounded-0" type="submit">
                                            EDIT
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='TaskMainBox'>
                            <div class='TaskBody rounded-3'>
                                No On Hold Task Found
                            </div>
                    </div>";
                }
                $stmt->close();
                $conn->close();
                ?>
            </div>
        </div>
    </main>
    <!-- Ajax Request for Search Bar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#searchBar').keyup(function() {
                var keyword = $(this).val();
                $.ajax({
                    url: 'fetch_tasks.php',
                    type: 'post',
                    data: {
                        keyword: keyword
                    },
                    success: function(response) {
                        $('#resultBox').html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>