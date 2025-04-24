<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}
$filter = isset($_GET['category']) ? $_GET['category'] : '';
$query = "SELECT * FROM jobs";
if ($filter != '') {
    $query .= " WHERE category='$filter'";
}
$jobs = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rozee.pk Clone - Jobs</title>
    <style>
        body {
            font-family: sans-serif;
            background: #eef1f5;
            margin: 0;
            padding: 0;
        }
        header {
            background: #00387c;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .top-buttons {
            text-align: center;
            margin: 20px 0 10px 0;
        }
        .top-buttons button {
            background-color: #00387c;
            color: white;
            border: none;
            padding: 10px 18px;
            margin: 0 8px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .top-buttons button:hover {
            background-color: #0052a5;
        }
        .filters {
            padding: 10px;
            text-align: center;
        }
        .filters button {
            margin: 5px;
            padding: 10px 20px;
            border: none;
            background: #00387c;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }
        .filters button:hover {
            background: #0052a5;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 15px;
            padding: 20px;
        }
        .job-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }
        .job-card h3 {
            margin: 0;
            color: #00387c;
        }
        .job-card p {
            margin: 5px 0;
        }
        .job-card button {
            margin-top: 10px;
            padding: 10px;
            background: #28a745;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }
        .job-card button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <header>
        <h1>Job Listings - Rozee.pk Clone</h1>
    </header>

    <!-- 👇 Top User Buttons (Profile, Post Job, My Applications) -->
    <div class="top-buttons">
        <button onclick="window.location='profile.php'">👤 Profile</button>
        <button onclick="window.location='postjob.php'">📢 Post Job</button>
        <button onclick="window.location='myapplications.php'">📄 My Applications</button>
    </div>

    <!-- 🔍 Category Filters -->
    <div class="filters">
        <button onclick="filter('')">All</button>
        <button onclick="filter('IT')">IT</button>
        <button onclick="filter('Marketing')">Marketing</button>
        <button onclick="filter('Engineering')">Engineering</button>
    </div>

    <!-- 📋 Job Grid -->
    <div class="grid">
        <?php while ($job = $jobs->fetch_assoc()) { ?>
            <div class="job-card">
                <h3><?= $job['title'] ?></h3>
                <p><strong>Company:</strong> <?= $job['company'] ?></p>
                <p><strong>Location:</strong> <?= $job['location'] ?></p>
                <button onclick="applyJob(<?= $job['id'] ?>)">Apply</button>
            </div>
        <?php } ?>
    </div>

    <script>
        function filter(category) {
            window.location = "index.php?category=" + category;
        }
        function applyJob(id) {
            window.location = "apply.php?id=" + id;
        }
    </script>
</body>
</html>
