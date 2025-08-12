<?php
session_start();
include("db_conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  $sql = "SELECT id, name, password FROM member WHERE email = ?";
  $stmt = mysqli_prepare($conn_SQL, $sql);
  if (!$stmt) {
      die("Prepare failed: (" . mysqli_errno($conn_SQL) . ") " . mysqli_error($conn_SQL));
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id, $name, $password_hash);

  if (mysqli_stmt_fetch($stmt)) {
    if (password_verify($password, $password_hash)) {
      $_SESSION['member_id'] = $id;
      $_SESSION['member_name'] = $name;
      header("Location: m_member_dashboard.php");
      exit;
    } else {
      $error = "密碼錯誤";
    }
  } else {
    $error = "查無此會員帳號";
  }

  mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>會員登入</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container py-5">
    <h2 class="mb-4">會員登入</h2>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif (!empty($_GET['msg']) && $_GET['msg'] === 'registered'): ?>
      <div class="alert alert-success">註冊成功，請登入</div>
    <?php endif; ?>

    <form method="post" novalidate>
      <div class="mb-3"><label class="form-label">電子信箱</label><input type="email" name="email" class="form-control" required></div>
      <div class="mb-3"><label class="form-label">密碼</label><input type="password" name="password" class="form-control" required></div>
      <button type="submit" class="btn btn-primary">登入</button>
    </form>

    <hr />
    <p>還沒有帳號？ <a href="m_member_add.php">點此註冊</a></p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
