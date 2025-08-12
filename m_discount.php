<?php
include("auth_check.php");
include("db_conn.php");

$result = mysqli_query($conn_SQL, "SELECT * FROM discounts ORDER BY valid_until DESC");
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>優惠管理</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <h2 class="mb-4">會員優惠管理</h2>
  <a href="m_discount_add.php" class="btn btn-success mb-3">新增優惠</a>
  <a href="admin_logout.php" class="btn btn-secondary mb-3 float-end">登出</a>

  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>優惠名稱</th>
        <th>內容說明</th>
        <th>有效期限</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['description']) ?></td>
        <td><?= htmlspecialchars($row['valid_until']) ?></td>
        <td>
          <a href="m_discount_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">修改</a>
          <a href="m_discount_delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('確定要刪除？')">刪除</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>

