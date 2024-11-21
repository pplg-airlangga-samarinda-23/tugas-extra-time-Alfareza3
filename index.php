<?php
include 'koneksi.php';
session_start();

function login($username, $password) {
    global $conn;

    $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);

    $hashed_password = md5($password);

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($username, $password)) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error_message = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <div class="bagian-kiri"></div>

        <div class="bagian-kanan">
            <div class="logo">👻🐦‍🔥👻</div>
            <form class="form-login" action="dashboard." method="post">
                <input type="text" placeholder="Username" class="input" required>
                <input type="password" placeholder="Password" class="input" required>
                <button type="submit" class="tombol-login">Login</button>
                <a href="#" class="lupa-password">Lupa Password?</a>
            </form>
            <a href="dashboard.php" class="lupa-password" target="_blank">Tanpa Login</a>
        </div>
    </div>
    <footer>
        <a href="https://wa.me/081256268182" target="_blank">&copy; 2024</a>
    </footer>
</body>
</html>