<?php
include("auth_check.php");
include("db_conn.php");

$id = $_GET['id'];
$result = mysqli_query($conn_SQL, "SELECT * FROM discounts WHERE id = $id");
$data = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $valid_until = $_POST['valid_until'];

  $stmt = mysqli_prepare($conn_SQL, "UPDATE discounts SET title=?, description=?, valid_until=? WHERE id=?");
  mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $valid_until, $id);
  mysqli_stmt_execute($stmt);
  header("Location: m_discount.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>修改優惠</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h2>修改優惠</h2>
  <form method="post">
    <div class="mb-3">
      <label>優惠名稱</label>
      <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($data['title']) ?>" required>
    </div>
    <div class="mb-3">
      <label>內容說明</label>
      <textarea name="description" class="form-control" required><?= htmlspecialchars($data['description']) ?></textarea>
    </div>
    <div class="mb-3">
      <label>有效期限</label>
      <input type="date" name="valid_until" class="form-control" value="<?= $data['valid_until'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">更新</button>
    <a href="m_discount.php" class="btn btn-secondary">取消</a>
  </form>
</body>
</html>

