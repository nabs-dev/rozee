<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}
$user_id = $_SESSION['user']['id'];
$result = $conn->query("SELECT j.title, j.company, j.location FROM jobs j INNER JOIN applications a ON j.id = a.job_id WHERE a.user_id = '$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Applications - Rozee.pk Clone</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; padding: 20px; }
        .card {
            background: white; padding: 20px; margin: 10px auto;
            border-radius: 10px; box-shadow: 0 0 5px rgba(0,0,0,0.05);
            max-width: 600px;
        }
        h2 { text-align: center; color: #00387c; }
    </style>
</head>
<body>
    <h2>Jobs You Applied To</h2>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="card">
            <h3><?= $row['title'] ?></h3>
            <p><strong>Company:</strong> <?= $row['company'] ?></p>
            <p><strong>Location:</strong> <?= $row['location'] ?></p>
        </div>
    <?php } ?>
</body>
</html>
