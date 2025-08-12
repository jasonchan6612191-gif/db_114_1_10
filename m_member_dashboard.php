<?php
session_start();
if (!isset($_SESSION['member_id'])) {
    header("Location: login_member.php");
    exit;
}
include("db_conn.php");

$member_id = $_SESSION['member_id'];
$sql = "SELECT * FROM member WHERE id = ?";
$stmt = mysqli_prepare($conn_SQL, $sql);
mysqli_stmt_bind_param($stmt, "i", $member_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$member = mysqli_fetch_assoc($result);

$discounts = mysqli_query($conn_SQL, "SELECT * FROM discounts ORDER BY valid_until DESC");
$events = mysqli_query($conn_SQL, "SELECT * FROM events ORDER BY event_date ASC");
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>會員專區</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
  <h2>歡迎，<?= htmlspecialchars($member['name']) ?>！</h2>
  <p>以下是你的專屬內容：</p>

  <section class="mt-4">
    <h4 class="text-primary">🎁 會員專屬優惠</h4>
    <table class="table table-bordered table-hover">
      <thead class="table-light">
        <tr>
          <th>優惠名稱</th>
          <th>內容說明</th>
          <th>有效期限</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($discounts)) { ?>
        <tr>
          <td><?= htmlspecialchars($row['title']) ?></td>
          <td><?= htmlspecialchars($row['description']) ?></td>
          <td><?= htmlspecialchars($row['valid_until']) ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>

  <section class="mt-5">
    <h4 class="text-success">📚 會員專屬課程 / 座談會</h4>
    <div class="row g-3">
      <?php while ($row = mysqli_fetch_assoc($events)) { ?>
      <div class="col-md-6">
        <div class="card h-100 border-success">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
            <p class="text-muted">時間：<?= htmlspecialchars($row['event_date']) ?><br>地點：<?= htmlspecialchars($row['location']) ?></p>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </section>

  <div class="mt-5">
    <a href="member_edit.php" class="btn btn-primary">修改個人資料</a>
    <a href="save_message.php" class="btn btn-secondary">會員留言板</a>
    <a href="member_logout.php" class="btn btn-danger">登出</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
