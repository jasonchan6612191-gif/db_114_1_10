<?php
include("auth_check.php");
include("db_conn.php");

$sql = "SELECT * FROM news ORDER BY date_posted DESC";
$result = mysqli_query($conn_SQL, $sql);
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8" />
  <title>最新消息管理</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-5">

  <h2 class="mb-4">最新消息管理</h2>

  <a href="m_news_add.php" class="btn btn-success mb-3">➕ 新增最新消息</a>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>編號</th>
        <th>日期</th>
        <th>標題</th>
        <th>發表人員</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['date_posted']) ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['author']) ?></td>
        <td>
          <a href="m_news_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">編輯</a>
          <a href="m_news_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
             onclick="return confirm('確定要刪除這筆資料嗎？');">刪除</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a href="admin_dashboard.php" class="btn btn-secondary mt-3">回後台首頁</a>

</body>
</html>

