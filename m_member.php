<?php
include("auth_check.php");
include("db_conn.php");

$sql = "SELECT * FROM member ORDER BY id ASC";
$result = mysqli_query($conn_SQL, $sql);
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8" />
  <title>會員列表</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-5">
  <h2 class="mb-4">會員列表</h2>
  <a href="m_member_add.php" class="btn btn-success mb-3">➕ 新增會員</a>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th><th>姓名</th><th>性別</th><th>電話</th><th>Email</th><th>服務類型</th><th>操作</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['gender']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['service_type']) ?></td>
        <td>
          <a href="m_member_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">編輯</a>
          <a href="m_member_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('確定要刪除這筆資料嗎？');">刪除</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <a href="admin_dashboard.php" class="btn btn-secondary">回後台首頁</a>
</body>
</html>
