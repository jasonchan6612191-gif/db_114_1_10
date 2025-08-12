<?php
include("auth_check.php");
include("db_conn.php");

$keyword = trim($_GET['keyword'] ?? '');
$category = trim($_GET['category'] ?? '');

$sql = "SELECT * FROM product WHERE 1";

if ($keyword !== '') {
  $keyword_safe = mysqli_real_escape_string($conn_SQL, $keyword);
  $sql .= " AND (product_name LIKE '%$keyword_safe%' OR product_code LIKE '%$keyword_safe%')";
}

if ($category !== '') {
  $category_safe = mysqli_real_escape_string($conn_SQL, $category);
  if ($category_safe === '未分類') {
    $sql .= " AND (category IS NULL OR category = '')";
  } else {
    $sql .= " AND category = '$category_safe'";
  }
}

$sql .= " ORDER BY id DESC";

$result = mysqli_query($conn_SQL, $sql);

$category_result = mysqli_query($conn_SQL, "SELECT DISTINCT category FROM product ORDER BY category");
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>產品管理</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-5">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>產品清單</h2>
    <a href="m_product_add.php" class="btn btn-success">＋ 新增產品</a>
  </div>

  <form method="get" class="mb-3">
    <div class="row g-2">
      <div class="col-md-5">
        <input type="text" name="keyword" class="form-control" placeholder="輸入產品名稱或編號查詢" value="<?= htmlspecialchars($keyword) ?>">
      </div>
      <div class="col-md-3">
        <select name="category" class="form-select">
          <option value="">全部分類</option>
          <option value="未分類" <?= ($category === '未分類' ? 'selected' : '') ?>>未分類</option>
          <?php while ($cat = mysqli_fetch_assoc($category_result)): ?>
            <option value="<?= htmlspecialchars($cat['category'] ?? '') ?>" <?= (($cat['category'] ?? '') === $category ? 'selected' : '') ?>>
              <?= htmlspecialchars($cat['category'] ?? '') ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">搜尋</button>
      </div>
      <div class="col-md-2">
        <a href="m_product.php" class="btn btn-secondary w-100">清除條件</a>
      </div>
    </div>
  </form>

  <table class="table table-bordered table-hover align-middle text-center">
    <thead class="table-dark">
      <tr>
        <th>編號</th>
        <th>產品名稱</th>
        <th>產品編號</th>
        <th>分類</th>
        <th>進貨日期</th>
        <th>進貨數量</th>
        <th>出貨日期</th>
        <th>出貨數量</th>
        <th>剩餘數量</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['product_name']) ?></td>
          <td><?= htmlspecialchars($row['product_code']) ?></td>
          <td><?= htmlspecialchars($row['category'] ?? '') ?></td>
          <td><?= $row['stock_date'] ?></td>
          <td><?= $row['stock_qty'] ?></td>
          <td><?= $row['ship_date'] ?></td>
          <td><?= $row['ship_qty'] ?></td>
          <td><?= $row['remain_qty'] ?></td>
          <td>
            <a href="m_product_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">修改</a>
            <a href="m_product_delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('確定要刪除嗎？')">刪除</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <div class="mt-4">
    <a href="admin_dashboard.php" class="btn btn-secondary">回後台首頁</a>
    <a href="index.php" class="btn btn-outline-dark ms-2">回首頁</a>
    <a href="logout.php" class="btn btn-danger ms-2">登出</a>
  </div>

</body>
</html>

