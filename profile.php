<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $skills = $_POST['skills'];
    $experience = $_POST['experience'];
    $education = $_POST['education'];

    $resume = $_FILES['resume']['name'];
    $tmp = $_FILES['resume']['tmp_name'];
    move_uploaded_file($tmp, "uploads/" . $resume);

    $check = $conn->query("SELECT * FROM profiles WHERE user_id='$user_id'");
    if ($check->num_rows > 0) {
        $conn->query("UPDATE profiles SET skills='$skills', experience='$experience', education='$education', resume='$resume' WHERE user_id='$user_id'");
    } else {
        $conn->query("INSERT INTO profiles (user_id, skills, experience, education, resume) VALUES ('$user_id', '$skills', '$experience', '$education', '$resume')");
    }
    echo "<script>alert('Profile Updated!');</script>";
}
$profile = $conn->query("SELECT * FROM profiles WHERE user_id='$user_id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile - Rozee.pk Clone</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 30px; }
        .box {
            max-width: 600px; margin: auto;
            background: white; padding: 25px;
            border-radius: 15px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; color: #00387c; }
        input, textarea, button {
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
    <h2>Edit Profile</h2>
    <form method="POST" enctype="multipart/form-data">
        <textarea name="skills" placeholder="Skills" required><?= $profile['skills'] ?? '' ?></textarea>
        <textarea name="experience" placeholder="Experience" required><?= $profile['experience'] ?? '' ?></textarea>
        <textarea name="education" placeholder="Education" required><?= $profile['education'] ?? '' ?></textarea>
        <input type="file" name="resume" required>
        <button type="submit">Save Profile</button>
    </form>
</div>
</body>
</html>
