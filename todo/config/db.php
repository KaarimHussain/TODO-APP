<?php
$hostname = "localhost";
$dbname = "todoapp";
$username = "root";
$password = "";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
