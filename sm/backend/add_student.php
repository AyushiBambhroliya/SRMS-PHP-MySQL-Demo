<?php
include "db.php";

$name = $_POST['name'];
$roll = $_POST['roll_no'];
$class = $_POST['class'];
$division = $_POST['division'];
$year = $_POST['admission_year'];

$sql = "INSERT INTO students (name, roll_no, class, division, admission_year)
        VALUES ('$name', '$roll', '$class', '$division', '$year')";

if (mysqli_query($conn, $sql)) {
    echo "Student Added Successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
