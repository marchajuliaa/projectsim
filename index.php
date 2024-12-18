<?php 
include 'config.php';
error_reporting(0);
session_start();

if (isset($_SESSION['username'])) {
    // Jika admin, arahkan ke admin homepage
    if ($_SESSION['role'] == 'admin') {
        header("Location: Homepage.php");
    } else {
        header("Location: user.php"); // User homepage
    }
    exit();
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            // Set session untuk login
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role']; // Set role admin/user

            // Redirect berdasarkan role
            if ($row['role'] == 'admin') {
                header("Location: Homepage.php");
            } else {
                header("Location: user.php");
            }
            exit();
        } else {
            echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
        }
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" type="text/css" href="style.css">
 
    <title>DATABASE MAHASISWA UNP</title>
</head>
<body>
    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['error']?>
    </div>
 
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p>
        </form>
    </div>
</body>
</html>