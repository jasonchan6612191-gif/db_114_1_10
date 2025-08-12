<?php
include("auth_check.php");
include("db_conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_posted = $_POST['date_posted'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    $sql = "INSERT INTO news (date_posted, title, content, author) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn_SQL, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $date_posted, $title, $content, $author);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: m_news.php");
        exit;
    } else {
        $error = "新增失敗: " . mysqli_error($conn_SQL);
    }
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8" />
    <title>新增最新消息</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-5">
    <h2>新增最新消息</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="date_posted" class="form-label">日期</label>
            <input type="date" id="date_posted" name="date_posted" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">標題</label>
            <input type="text" id="title" name="title" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">內文</label>
            <textarea id="content" name="content" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">發表人員</label>
            <input type="text" id="author" name="author" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary">新增</button>
    </form>

    <a href="m_news.php" class="btn btn-secondary mt-3">回最新消息管理</a>
</body>
</html>


<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8" />
  <title>新增最新消息</title>
  <link href="https://cdn.jsdelivr
