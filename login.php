<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
    if ($result->num_rows > 0) {
        $_SESSION['user'] = $result->fetch_assoc();
        echo "<script>window.location='index.php';</script>";
    } else {
        $error = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Rozee.pk Clone</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h2 {
            color: #00387c;
            text-align: center;
        }
        input, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
        }
        input {
            border: 1px solid #ccc;
        }
        button {
            background: #00387c;
            color: white;
            border: none;
            font-weight: bold;
        }
        .redirect {
            text-align: center;
            margin-top: 10px;
        }
        .redirect a {
            color: #00387c;
            text-decoration: none;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
            <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
        <div class="redirect">
            Don't have an account? <a href="#" onclick="goSignup()">Sign Up</a>
        </div>
    </div>

    <script>
        function goSignup() {
            window.location = "signup.php";
        }
    </script>
</body>
</html>
