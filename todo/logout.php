<?php
include "./config/session.php";
session_unset();
header("Location: ./index.php");
exit();
