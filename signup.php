<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $error = "Email already exists!";
    } else {
        $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$pass')");
        echo "<script>window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - Rozee.pk Clone</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signup-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
            color: #00387c;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #00387c;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
        }
        .error {
            color: red;
            text-align: center;
        }
        .redirect {
            text-align: center;
            margin-top: 10px;
        }
        .redirect a {
            color: #00387c;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="signup-box">
    <h2>Create Account</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Sign Up</button>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    </form>
    <div class="redirect">
        Already have an account? <a href="#" onclick="redirectToLogin()">Login</a>
    </div>
</div>

<script>
    function redirectToLogin() {
        window.location = "login.php";
    }
</script>
</body>
</html>
