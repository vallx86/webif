<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="login.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Informatika</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1> 
        <form action="Login.php" method="post" enctype="multipart/form-data">
            <label for="email">Email:</label><br>
            <input type="email" name="email" required><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" required><br>

            <div class="remember-me">
                <input type="checkbox" name="ingat" value="1">
                <label for="ingat">Ingatkan saya!</label><br>
            </div>

            <input type="submit" value="Login" class="btn"><br>
        </form>
        <p>Belum punya akun? <a href="register.html">Daftar</a></p>
    </div>
</body>
</html>
