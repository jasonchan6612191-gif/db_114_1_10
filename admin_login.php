<?php
session_start();
include("db_conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    // 防止 SQL Injection
    $user = mysqli_real_escape_string($conn_SQL, $user);
    $pass = mysqli_real_escape_string($conn_SQL, $pass);

    $sql = "SELECT * FROM admin WHERE username='$user' AND password='$pass'";
    $result = mysqli_query($conn_SQL, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $user;
        header("Location: m_product.php");
        exit;
    } else {
        echo "登入失敗";
    }
} else {
    header("Location: login_admin.html");
    exit;
}
?>


