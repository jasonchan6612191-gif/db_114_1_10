<?php
include("auth_check.php");
include("db_conn.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: m_news.php");
    exit;
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date_posted = $_POST['date_posted'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    $sql = "UPDATE news SET date_posted=?, title=?, content=?, author=? WHERE id=?";
    $stmt = mysqli_prepare($conn_SQL, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $date_posted, $title, $content, $author, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: m_news.php");
    exit;
}

$sql = "SELECT * FROM news WHERE id=?";
$stmt = mysqli_prepare($conn_SQL, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$row) {
    echo "找不到此筆資料";
    exit;
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8" />
<title>編輯最新消息</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-5">

<h2>編輯最新消息</h2>

<form method="post">
    <div class="mb-3">
        <label for="date_posted" class="form-label">日期</label>
        <input type="date" id="date_posted" name="date_posted" class="form-control" required value="<?= htmlspecialchars($row['date_posted']) ?>">
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">標題</label>
        <input type="text" id="title" name="title" class="form-control" required value="<?= htmlspecialchars($row['title']) ?>">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">內文</label>
        <textarea id="content" name="content" class="form-control" rows="5" required><?= htmlspecialchars($row['content']) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">發表人員</label>
        <input type="text" id="author" name="author" class="form-control" required value="<?= htmlspecialchars($row['author']) ?>">
    </div>
    <button type="submit" class="btn btn-primary">更新</button>
</form>

<a href="m_news.php" class="btn btn-secondary mt-3">回最新消息管理</a>

</body>
</html>


