<?php
include("auth_check.php");
include("db_conn.php");

// 分頁設定
$perPage = 20;
$page = max(1, intval($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;

// 篩選分類
$categoryFilter = $_GET['category'] ?? 'all';
$categoryWhere = '';
if ($categoryFilter === '會員') {
    $categoryWhere = "WHERE category = '會員'";
} elseif ($categoryFilter === '訪客') {
    $categoryWhere = "WHERE category = '訪客'";
}

// 取得資料
$sql = "SELECT * FROM message $categoryWhere ORDER BY created_at DESC LIMIT $offset, $perPage";
$result = mysqli_query($conn_SQL, $sql);

// 分類資料
$visitorRows = [];
$memberRows = [];

while ($row = mysqli_fetch_assoc($result)) {
    $categories = explode(',', $row['category'] ?? '');
    if (in_array('會員', $categories)) {
        $memberRows[] = $row;
    } else {
        $visitorRows[] = $row;
    }
}

// 總數與分頁
$totalResult = mysqli_query($conn_SQL, "SELECT COUNT(*) AS total FROM message $categoryWhere");
$totalRow = mysqli_fetch_assoc($totalResult);
$totalMessages = intval($totalRow['total']);
$totalPages = ceil($totalMessages / $perPage);
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8" />
  <title>留言管理</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-5">
  <h1 class="mb-4">留言管理</h1>
  <a href="admin_dashboard.php" class="btn btn-secondary mb-3">回管理首頁</a>

  <!-- 分類篩選 -->
  <form method="get" class="mb-4 text-center">
    <label for="category" class="me-2">顯示分類：</label>
    <select name="category" id="category" onchange="this.form.submit()" class="form-select d-inline-block w-auto">
      <option value="all" <?= $categoryFilter === 'all' ? 'selected' : '' ?>>全部</option>
      <option value="會員" <?= $categoryFilter === '會員' ? 'selected' : '' ?>>會員</option>
      <option value="訪客" <?= $categoryFilter === '訪客' ? 'selected' : '' ?>>訪客</option>
    </select>
  </form>

  <?php if ($categoryFilter !== '訪客'): ?>
  <h4 class="text-primary mb-3">會員留言</h4>
  <table class="table table-bordered align-middle text-center mb-5">
    <thead class="table-success">
      <tr>
        <th>#</th>
        <th>姓名</th>
        <th>Email</th>
        <th>留言內容</th>
        <th>留言類型</th> <!-- 修改這裡 -->
        <th>回覆</th>
        <th>留言時間</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php $i = 1; foreach ($memberRows as $row): $id = $row['id']; ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><a href="mailto:<?= rawurlencode($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a></td>
        <td><?= nl2br(htmlspecialchars($row['content'])) ?></td>
        <!-- 顯示前台服務選項 -->
        <td><?= htmlspecialchars($row['service_type'] ?? '') ?></td>
        <td><?= nl2br(htmlspecialchars($row['reply'] ?? '')) ?></td>
        <td><?= $row['created_at'] ?></td>
        <td>
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $id ?>">編輯</button>
          <a href="m_message_delete.php?id=<?= $id ?>" class="btn btn-sm btn-danger" onclick="return confirm('確定刪除這則留言？');">刪除</a>
        </td>
      </tr>

      <!-- Modal -->
      <div class="modal fade" id="editModal<?= $id ?>" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="m_message_edit_save.php">
              <div class="modal-header">
                <h5 class="modal-title">回覆留言</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="mb-2">
                  <label>留言內容</label>
                  <textarea class="form-control" rows="3" disabled><?= htmlspecialchars($row['content']) ?></textarea>
                </div>
                <div class="mb-2">
                  <label>回覆內容</label>
                  <textarea name="reply" class="form-control" rows="3"><?= htmlspecialchars($row['reply'] ?? '') ?></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">儲存</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>

  <?php if ($categoryFilter !== '會員'): ?>
  <h4 class="text-secondary mb-3">訪客留言</h4>
  <table class="table table-bordered align-middle text-center">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>姓名</th>
        <th>Email</th>
        <th>留言內容</th>
        <th>留言類型</th> <!-- 修改這裡 -->
        <th>回覆</th>
        <th>留言時間</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php $j = 1; foreach ($visitorRows as $row): $id = $row['id']; ?>
      <tr>
        <td><?= $j++ ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><a href="mailto:<?= rawurlencode($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a></td>
        <td><?= nl2br(htmlspecialchars($row['content'])) ?></td>
        <!-- 顯示前台服務選項 -->
        <td><?= htmlspecialchars($row['service_type'] ?? '') ?></td>
        <td><?= nl2br(htmlspecialchars($row['reply'] ?? '')) ?></td>
        <td><?= $row['created_at'] ?></td>
        <td>
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $id ?>">編輯</button>
          <a href="m_message_delete.php?id=<?= $id ?>" class="btn btn-sm btn-danger" onclick="return confirm('確定刪除這則留言？');">刪除</a>
        </td>
      </tr>

      <!-- Modal -->
      <div class="modal fade" id="editModal<?= $id ?>" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="m_message_edit_save.php">
              <div class="modal-header">
                <h5 class="modal-title">回覆留言</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="mb-2">
                  <label>留言內容</label>
                  <textarea class="form-control" rows="3" disabled><?= htmlspecialchars($row['content']) ?></textarea>
                </div>
                <div class="mb-2">
                  <label>回覆內容</label>
                  <textarea name="reply" class="form-control" rows="3"><?= htmlspecialchars($row['reply'] ?? '') ?></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">儲存</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>

  <!-- 分頁 -->
  <nav>
    <ul class="pagination justify-content-center">
      <?php for ($p = 1; $p <= $totalPages; $p++): ?>
        <li class="page-item <?= ($p == $page) ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $p ?>&category=<?= urlencode($categoryFilter) ?>">第 <?= $p ?> 頁</a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
