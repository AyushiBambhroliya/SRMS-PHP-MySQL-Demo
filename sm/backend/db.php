<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "student_result_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>
