<?php
include("auth_check.php");
include("db_conn.php");

$sql = "SELECT * FROM message ORDER BY created_at DESC";
$result = mysqli_query($conn_SQL, $sql);

$visitorRows = [];
$memberRows = [];

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $check_member = mysqli_query($conn_SQL, "SELECT * FROM member WHERE name = '$name' LIMIT 1");
    $row['is_member'] = (mysqli_num_rows($check_member) > 0);
    if ($row['is_member']) {
        $memberRows[] = $row;
    } else {
        $visitorRows[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>留言管理</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h1 class="mb-4">留言管理</h1>
  <a href="admin_dashboard.php" class="btn btn-secondary mb-4">回管理首頁</a>

  <h4 class="text-primary mb-3">會員留言</h4>
  <table class="table table-bordered align-middle text-center mb-5">
    <thead class="table-success">
      <tr>
        <th>#</th>
        <th>姓名</th>
        <th>Email</th>
        <th>留言內容</th>
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
        <td><?= nl2br(htmlspecialchars($row['reply'] ?? '')) ?></td>
        <td><?= $row['created_at'] ?></td>
        <td>
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $id ?>">編輯</button>
          <a href="m_service_delete.php?id=<?= $id ?>" class="btn btn-sm btn-danger" onclick="return confirm('確定刪除這則留言？');">刪除</a>
        </td>
      </tr>
      <div class="modal fade" id="editModal<?= $id ?>" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="m_service_edit_save.php">
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

  <h4 class="text-secondary mb-3">訪客留言</h4>
  <table class="table table-bordered align-middle text-center">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>姓名</th>
        <th>Email</th>
        <th>留言內容</th>
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
        <td><?= nl2br(htmlspecialchars($row['reply'] ?? '')) ?></td>
        <td><?= $row['created_at'] ?></td>
        <td>
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $id ?>">編輯</button>
          <a href="m_service_delete.php?id=<?= $id ?>" class="btn btn-sm btn-danger" onclick="return confirm('確定刪除這則留言？');">刪除</a>
        </td>
      </tr>
      <div class="modal fade" id="editModal<?= $id ?>" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="m_service_edit_save.php">
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

