<?php
session_start();
if (!isset($_SESSION['member_id'])) {
    header("Location: login_member.php");
    exit;
}
include("db_conn.php");

// 取得會員姓名與 Email，供表單預填
$member_id = $_SESSION['member_id'];
$sql = "SELECT name, email FROM member WHERE id = ?";
$stmt = mysqli_prepare($conn_SQL, $sql);
mysqli_stmt_bind_param($stmt, "i", $member_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$member = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8" />
  <title>會員留言板</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
  <h2>會員留言板</h2>
  <form method="post" action="m_message_save.php">
    <div class="mb-3">
      <label for="name" class="form-label">姓名</label>
      <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($member['name']) ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">電子信箱</label>
      <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($member['email']) ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="message" class="form-label">留言內容</label>
      <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
    </div>
    <!-- 隱藏欄位標記留言為會員留言 -->
    <input type="hidden" name="category" value="會員">
    <button type="submit" class="btn btn-primary">送出留言</button>
    <a href="m_member_dashboard.php" class="btn btn-secondary">回會員專區</a>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

