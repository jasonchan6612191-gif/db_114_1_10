<?php
include("auth_check.php");
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8" />
  <title>管理員後台首頁</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .btn-column {
      width: 250px;
      margin-bottom: 15px;
    }
  </style>
</head>

<body class="d-flex flex-column align-items-center py-5">

  <h1 class="mb-4 text-center">管理員後台</h1>

  <div class="d-flex flex-column align-items-center">
    <a class="btn btn-primary btn-column" href="m_product.php">產品管理</a>
    <a class="btn btn-primary btn-column" href="m_member.php">會員管理</a>
    <a class="btn btn-primary btn-column" href="m_news.php">最新消息管理</a>
    <a class="btn btn-primary btn-column" href="m_service.php">留言管理</a>
    <a class="btn btn-warning btn-column" href="m_discount.php">會員優惠管理</a>
    <a class="btn btn-success btn-column" href="m_event.php">課程 / 座談會管理</a>
    <a class="btn btn-info btn-column" href="m_firmware.php">韌體下載管理</a>
    <a class="btn btn-outline-dark btn-column" href="index.php">回首頁</a>
    <a class="btn btn-danger btn-column" href="logout.php">登出</a>
  </div>

  <p class="mt-4 text-center">
    歡迎，<?= htmlspecialchars($_SESSION['admin']) ?>！請從上方選擇管理項目。
  </p>

</body>
</html>
