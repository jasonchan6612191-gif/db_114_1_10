<?php
include("auth_check.php");
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $valid_until = $_POST['valid_until'];

  $stmt = mysqli_prepare($conn_SQL, "INSERT INTO discounts (title, description, valid_until) VALUES (?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "sss", $title, $description, $valid_until);
  mysqli_stmt_execute($stmt);
  header("Location: m_discount.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>新增優惠</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h2>新增優惠</h2>
  <form method="post">
    <div class="mb-3">
      <label>優惠名稱</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>內容說明</label>
      <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label>有效期限</label>
      <input type="date" name="valid_until" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">儲存</button>
    <a href="m_discount.php" class="btn btn-secondary">取消</a>
  </form>
</body>
</html>


