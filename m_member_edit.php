<?php
include("auth_check.php");
include("db_conn.php");

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $service_type = $_POST['service_type'];

    
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE member SET name=?, gender=?, phone=?, email=?, service_type=?, password=? WHERE id=?";
        $stmt = mysqli_prepare($conn_SQL, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssi", $name, $gender, $phone, $email, $service_type, $password, $id);
    } else {
        $sql = "UPDATE member SET name=?, gender=?, phone=?, email=?, service_type=? WHERE id=?";
        $stmt = mysqli_prepare($conn_SQL, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $name, $gender, $phone, $email, $service_type, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        header("Location: m_member.php");
        exit;
    } else {
        $error = "更新失敗: " . mysqli_error($conn_SQL);
    }
}


$sql = "SELECT * FROM member WHERE id=?";
$stmt = mysqli_prepare($conn_SQL, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8" />
  <title>編輯會員</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-5">
  <h2>編輯會員</h2>
  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <form method="post">
    <div class="mb-3"><label class="form-label">姓名</label><input type="text" name="name" class="form-control" value="<?= htmlspecialchars($row['name']) ?>" required></div>
    <div class="mb-3">
      <label class="form-label">性別</label>
      <select name="gender" class="form-select" required>
        <option value="男" <?= $row['gender'] === '男' ? 'selected' : '' ?>>男</option>
        <option value="女" <?= $row['gender'] === '女' ? 'selected' : '' ?>>女</option>
      </select>
    </div>
    <div class="mb-3"><label class="form-label">電話</label><input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($row['phone']) ?>" required></div>
    <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>" required></div>
    <div class="mb-3"><label class="form-label">服務類型</label><input type="text" name="service_type" class="form-control" value="<?= htmlspecialchars($row['service_type']) ?>" required></div>
    <div class="mb-3"><label class="form-label">密碼（留空不修改）</label><input type="password" name="password" class="form-control"></div>
    <button type="submit" class="btn btn-primary">更新</button>
  </form>
  <a href="m_member.php" class="btn btn-secondary mt-3">回會員列表</a>
</body>
</html>
