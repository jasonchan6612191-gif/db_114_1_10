<?php
include("auth_check.php");
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $event_date = $_POST['event_date'];
  $location = $_POST['location'];

  $stmt = mysqli_prepare($conn_SQL, "INSERT INTO events (title, description, event_date, location) VALUES (?, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "ssss", $title, $description, $event_date, $location);
  mysqli_stmt_execute($stmt);
  header("Location: m_event.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>新增活動</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h2>新增課程／活動</h2>
  <form method="post">
    <div class="mb-3">
      <label>活動名稱</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>說明</label>
      <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label>活動日期</label>
      <input type="date" name="event_date" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>地點</label>
      <input type="text" name="location" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">儲存</button>
    <a href="m_event.php" class="btn btn-secondary">取消</a>
  </form>
</body>
</html>

