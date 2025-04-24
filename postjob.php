<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $conn->query("INSERT INTO jobs (title, company, location, category, description) VALUES ('$title', '$company', '$location', '$category', '$description')");
    echo "<script>alert('Job Posted!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post Job - Rozee.pk Clone</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 30px; }
        .box {
            max-width: 600px; margin: auto;
            background: white; padding: 25px;
            border-radius: 15px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; color: #00387c; }
        input, textarea, select, button {
            width: 100%; margin: 10px 0; padding: 12px;
            border-radius: 8px; border: 1px solid #ccc;
        }
        button {
            background: #00387c; color: white; border: none;
        }
    </style>
</head>
<body>
<div class="box">
    <h2>Post a Job</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Job Title" required />
        <input type="text" name="company" placeholder="Company Name" required />
        <input type="text" name="location" placeholder="Location" required />
        <select name="category" required>
            <option value="">Select Category</option>
            <option value="IT">IT</option>
            <option value="Marketing">Marketing</option>
            <option value="Engineering">Engineering</option>
        </select>
        <textarea name="description" placeholder="Job Description" required></textarea>
        <button type="submit">Post Job</button>
    </form>
</div>
</body>
</html>
