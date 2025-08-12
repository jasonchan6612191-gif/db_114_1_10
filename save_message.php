<?php
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $content = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $content === '') {
        echo "<script>alert('請完整填寫姓名、電子信箱與留言內容。'); history.back();</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('請輸入有效的電子信箱。'); history.back();</script>";
        exit;
    }

    $stmt = $conn_SQL->prepare("INSERT INTO message (name, email, content, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $name, $email, $content);

    if ($stmt->execute()) {
        echo "<script>
            alert('您的留言已送出，本公司將會盡快安排工作人員與您聯絡，謝謝您！');
            window.location.href='index.php';
        </script>";
    } else {
        echo "<script>alert('留言送出失敗，請稍後再試。'); history.back();</script>";
    }

    $stmt->close();
    $conn_SQL->close();
} else {
    header("Location: index.php");
    exit;
}
?>
