<?php
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 取得並整理表單資料
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $content = trim($_POST['message'] ?? '');
    // 會員或訪客類別，預設為訪客
    $category = trim($_POST['category'] ?? '訪客');

    // 基本欄位驗證
    if ($name === '' || $email === '' || $content === '') {
        echo "<script>alert('請完整填寫姓名、電子信箱與留言內容。'); history.back();</script>";
        exit;
    }

    // email 格式驗證
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('請輸入有效的電子信箱。'); history.back();</script>";
        exit;
    }

    // 準備 SQL，包含 category 欄位
    $stmt = $conn_SQL->prepare("INSERT INTO message (name, email, content, category, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $name, $email, $content, $category);

    if ($stmt->execute()) {
        echo "<script>
            alert('您的留言已送出，本公司將會盡快安排工作人員與您聯絡，謝謝您！');
            window.location.href='index.php'; // 或導向適合的頁面，如會員留言板
        </script>";
    } else {
        echo "<script>alert('留言送出失敗，請稍後再試。'); history.back();</script>";
    }

    $stmt->close();
    $conn_SQL->close();
} else {
    header("Location: index.php"); // 非 POST 請求跳轉
    exit;
}
?>
