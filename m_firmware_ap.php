<?php
include("db_conn.php");
$table = "firmware_ap";

if (isset($_POST['add'])) {
  $name = $_POST['product_name'];
  $version = $_POST['firmware_version'];
  $desc = $_POST['description'];
  $link = $_POST['download_link'];
  mysqli_query($conn_SQL, "INSERT INTO $table (product_name, firmware_version, description, download_link) VALUES ('$name', '$version', '$desc', '$link')");
  header("Location: m_firmware_ap.php");
  exit;
}

if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  mysqli_query($conn_SQL, "DELETE FROM $table WHERE id=$id");
  header("Location: m_firmware_ap.php");
  exit;
}

if (isset($_POST['edit'])) {
  $id = intval($_POST['id']);
  $name = $_POST['product_name'];
  $version = $_POST['firmware_version'];
  $desc = $_POST['description'];
  $link = $_POST['download_link'];
  mysqli_query($conn_SQL, "UPDATE $table SET product_name='$name', firmware_version='$version', description='$desc', download_link='$link' WHERE id=$id");
  header("Location: m_firmware_ap.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>無線 AP 韌體管理</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .form-control { font-size: 0.9rem; }
    .container-sm { max-width: 900px; margin-top: 50px; }
  </style>
</head>
<body class="bg-light">

  <div class="container-sm py-4">
    <div class="card shadow">
      <div class="card-header text-center"><h4>無線 AP 韌體管理</h4></div>
      <div class="card-body">

        <form method="POST" class="row g-2 mb-4">
          <div class="col-md-6"><input type="text" name="product_name" class="form-control" placeholder="產品名稱" required></div>
          <div class="col-md-6"><input type="text" name="firmware_version" class="form-control" placeholder="韌體版本" required></div>
          <div class="col-md-6"><input type="text" name="description" class="form-control" placeholder="簡介" required></div>
          <div class="col-md-6"><input type="text" name="download_link" class="form-control" placeholder="下載連結" required></div>
          <div class="col-12 text-center"><button type="submit" name="add" class="btn btn-primary">新增韌體</button></div>
        </form>

        <table class="table table-bordered table-hover text-center align-middle">
          <thead class="table-light">
            <tr><th>產品名稱</th><th>版本</th><th>說明</th><th>下載連結</th><th>操作</th></tr>
          </thead>
          <tbody>
          <?php
            $result = mysqli_query($conn_SQL, "SELECT * FROM $table ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <form method="POST">
                <td><input type="text" name="product_name" class="form-control" value="<?= htmlspecialchars($row['product_name']) ?>"></td>
                <td><input type="text" name="firmware_version" class="form-control" value="<?= htmlspecialchars($row['firmware_version']) ?>"></td>
                <td><input type="text" name="description" class="form-control" value="<?= htmlspecialchars($row['description']) ?>"></td>
                <td><input type="text" name="download_link" class="form-control" value="<?= htmlspecialchars($row['download_link']) ?>"></td>
                <td>
                  <input type="hidden" name="id" value="<?= $row['id'] ?>">
                  <button type="submit" name="edit" class="btn btn-sm btn-success mb-1">儲存</button><br>
                  <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('確定刪除？')">刪除</a>
                </td>
              </form>
            </tr>
          <?php } ?>
          </tbody>
        </table>

        <div class="text-center mt-3">
          <a href="m_firmware.php" class="btn btn-secondary">回韌體分類列表</a>
        </div>
      </div>
    </div>
  </div>

</body>
</html>

