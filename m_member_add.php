<?php
include("db_conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $service_type = $_POST['service_type'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$name || !$gender || !$phone || !$email || !$service_type || !$password) {
        $error = "請完整填寫所有欄位";
    } else {
        $sql_check = "SELECT id FROM member WHERE email = ?";
        $stmt = mysqli_prepare($conn_SQL, $sql_check);
        if (!$stmt) {
            die("SQL準備錯誤: " . mysqli_error($conn_SQL));
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = "此電子信箱已被註冊";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $sql_insert = "INSERT INTO member (name, gender, phone, email, service_type, password) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt2 = mysqli_prepare($conn_SQL, $sql_insert);
            if (!$stmt2) {
                die("SQL準備錯誤: " . mysqli_error($conn_SQL));
            }
            mysqli_stmt_bind_param($stmt2, "ssssss", $name, $gender, $phone, $email, $service_type, $password_hash);
            if (mysqli_stmt_execute($stmt2)) {
                mysqli_stmt_close($stmt2);
                mysqli_stmt_close($stmt);
                header("Location: login_member.php?msg=registered");
                exit;
            } else {
                $error = "註冊失敗，請稍後再試";
            }
            mysqli_stmt_close($stmt2);
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>會員註冊</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">會員註冊</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post" novalidate>
    <div class="mb-3"><label class="form-label">姓名</label><input type="text" name="name" class="form-control" required></div>
    <div class="mb-3">
      <label class="form-label">性別</label>
      <select name="gender" class="form-select" required>
        <option value="">請選擇</option>
        <option value="男">男</option>
        <option value="女">女</option>
      </select>
    </div>
    <div class="mb-3"><label class="form-label">電話</label><input type="text" name="phone" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">電子信箱</label><input type="email" name="email" class="form-control" required></div>
    <fieldset class="mb-3">
      <legend class="col-form-label pt-0">服務類型</legend>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="service_type" id="service1" value="維修服務" required>
        <label class="form-check-label" for="service1">維修服務</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="service_type" id="service2" value="課程安排">
        <label class="form-check-label" for="service2">課程安排</label>
      </div>
    </fieldset>
    <div class="mb-3"><label class="form-label">密碼</label><input type="password" name="password" class="form-control" required></div>
    <button type="submit" class="btn btn-primary">註冊</button>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
