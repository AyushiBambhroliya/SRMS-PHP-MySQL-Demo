<?php
include "db.php";

if(!isset($_GET['roll_no']) || empty($_GET['roll_no'])){
    die("Error: Roll Number not provided.");
}

$roll_no = mysqli_real_escape_string($conn, $_GET['roll_no']);

$sql = "
SELECT students.name, students.photo, subjects.subject_name, results.marks
FROM results
JOIN students ON results.student_id = students.student_id
JOIN subjects ON results.subject_id = subjects.subject_id
WHERE students.roll_no = '$roll_no'
";

$result = mysqli_query($conn, $sql);
if(!$result){ die("Query Failed: " . mysqli_error($conn)); }
if(mysqli_num_rows($result) == 0){
    echo "<div class='container'><div class='student-card'><h2 style='color:red;'>No Result Found</h2>
    <p>Roll Number <b>$roll_no</b> does not exist.</p>
    <a href='index.html' class='btn'>🔙 Back to Home</a></div></div>";
    exit;
}

$row1 = mysqli_fetch_assoc($result);
$student_name = $row1['name'];
$student_photo = $row1['photo']; // store filename in DB
mysqli_data_seek($result, 0);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Result</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Student Result Card</h1>
</header>

<div class="container">

    <!-- Student Info Card -->
    <div class="student-card">
        <img src="C:\Users\Admin\Desktop\data ar\Data science\sm\public\images/student1<?= $student_photo ?>" alt="<?= $student_name ?>">
        <h2><?= $student_name ?></h2>
        <p><b>Roll No:</b> <?= $roll_no ?></p>
    </div>

    <!-- Marks Table -->
    <div class="student-card">
        <h2>Subject-wise Marks</h2>
        <table>
            <tr>
                <th>Subject</th>
                <th>Marks</th>
                <th>Grade</th>
                <th>Progress</th>
            </tr>
            <?php
            while($row = mysqli_fetch_assoc($result)) {
                $marks = $row['marks'];
                if($marks >= 90){ $grade='A'; $color='#28a745'; }
                elseif($marks >= 75){ $grade='B'; $color='#ffc107'; }
                else { $grade='C'; $color='#dc3545'; }

                echo "<tr>
                        <td>{$row['subject_name']}</td>
                        <td>{$marks}</td>
                        <td style='color:$color; font-weight:bold;'>$grade</td>
                        <td>
                            <div class='progress-container'>
                                <div class='progress-bar' style='width: {$marks}%; background:$color;'>{$marks}%</div>
                            </div>
                        </td>
                      </tr>";
            }
            ?>
        </table>
    </div>

    <a href="index.html" class="btn">🔙 Back to Home</a>

</div>
</body>
</html>
