<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user']['id'];
$job_id = $_GET['id'];

$alreadyApplied = $conn->query("SELECT * FROM applications WHERE user_id='$user_id' AND job_id='$job_id'");
if ($alreadyApplied->num_rows == 0) {
    $conn->query("INSERT INTO applications (user_id, job_id) VALUES ('$user_id', '$job_id')");
    echo "<script>alert('Application submitted!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('You already applied to this job!'); window.location='index.php';</script>";
}
?>
