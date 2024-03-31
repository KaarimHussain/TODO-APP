<?php
include "./config/session.php";
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
include "./config/db.php";

$user_id = $_SESSION['logged']['id'];
$sql = "SELECT * FROM tasks WHERE completed = 1 AND user_id = $user_id";
$stmt = $conn->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History | Todo - Kaarim Hussain</title>
    <?php
    include "./config/fonts.php";
    include "./config/icons.php";
    include "./config/bootstrap.php";
    ?>
    <link rel="stylesheet" href="./styles/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./styles/history.css?v=<?php echo time(); ?>">

</head>

<body>
    <section>
        <a href="dashboard.php" class="goBackLink"><i class="bi bi-arrow-counterclockwise"></i> Go Back</a>
        <h3 class="text-center fw-light">Your History of Task</h3>
        <div class="container mt-5">
            <table class="w-100 bg-transparent">
                <thead class="tableHead">
                    <tr>
                        <th class="p-3 fw-light" scope="col">Title</th>
                        <th class="p-3 fw-light" scope="col">Completed</th>
                        <th class="p-3 fw-light" scope="col">Created at</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='p-3 fw-light'>" . $row['title'] . "</td>";
                            echo "<td class='p-3 fw-light'>";
                            if ($row['completed'] == 1) {
                                echo "<span>Done</span>";
                            }
                            echo "</td>";
                            echo "<td class='p-3 fw-light'>" . $row['created_at'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='text-center fw-bold p-3'>No Task Found</td></tr>";
                    }

                    $stmt->close();
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>