<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("auth_check.php");
include("db_conn.php");

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("ID 不合法");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = trim($_POST['product_name'] ?? '');
    $code     = trim($_POST['product_code'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $sdate    = $_POST['stock_date'] ?? '';
    $sqty     = intval($_POST['stock_qty'] ?? 0);
    $shdate   = $_POST['ship_date'] ?? '';
    $shqty    = intval($_POST['ship_qty'] ?? 0);
    $desc     = trim($_POST['product_desc'] ?? '');
    $remain   = $sqty - $shqty;

    $sql_update = "UPDATE product SET 
        product_name=?, 
        product_code=?, 
        category=?, 
        stock_date=?, 
        stock_qty=?, 
        ship_date=?, 
        ship_qty=?, 
        remain_qty=?, 
        product_desc=?
        WHERE id=?";

    $stmt = mysqli_prepare($conn_SQL, $sql_update);
    if ($stmt === false) {
        die("❌ SQL 預處理失敗：" . mysqli_error($conn_SQL));
    }

    // 修正型別字串：ship_date 要用 s
    mysqli_stmt_bind_param(
        $stmt,
        'ssssisissi',
        $name,
        $code,
        $category,
        $sdate,
        $sqty,
        $shdate,
        $shqty,
        $remain,
        $desc,
        $id
    );

    if (!mysqli_stmt_execute($stmt)) {
        die("❌ 更新失敗：" . mysqli_error($conn_SQL));
    }

    mysqli_stmt_close($stmt);
    header("Location: m_product.php");
    exit;
}

// 取出產品資料
$sql = "SELECT * FROM product WHERE id=?";
$stmt = mysqli_prepare($conn_SQL, $sql);
if ($stmt === false) {
    die("❌ SQL 預處理失敗：" . mysqli_error($conn_SQL));
}
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result) ?: [];
mysqli_stmt_close($stmt);

if (!$row) {
    die("找不到該產品");
}

// 取得分類選項
$category_result = mysqli_query(
    $conn_SQL,
    "SELECT DISTINCT category FROM product WHERE category<>'' ORDER BY category"
) or die("❌ 取分類失敗：" . mysqli_error($conn_SQL));

$categories = [];
while ($cat = mysqli_fetch_assoc($category_result)) {
    $categories[] = $cat['category'];
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>編輯產品</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
</head>
<body class="container py-4">

<h1 class="mb-4">編輯產品</h1>
<a href="m_product.php" class="btn btn-secondary mb-3">回產品管理</a>

<form method="post">
  <div class="mb-3">
    <label class="form-label">產品名稱</label>
    <input type="text" name="product_name" class="form-control" required value="<?= htmlspecialchars($row['product_name'] ?? '') ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">產品編號</label>
    <input type="text" name="product_code" class="form-control" required value="<?= htmlspecialchars($row['product_code'] ?? '') ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">產品分類</label>
    <select name="category" class="form-select">
      <option value="">-- 請選擇分類 --</option>
      <?php foreach ($categories as $cat): ?>
      <option value="<?= htmlspecialchars($cat) ?>" <?= ($cat === ($row['category'] ?? '')) ? 'selected' : '' ?>>
        <?= htmlspecialchars($cat) ?>
      </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">進貨日期</label>
    <input type="date" name="stock_date" class="form-control" required value="<?= $row['stock_date'] ?? '' ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">進貨數量</label>
    <input type="number" name="stock_qty" class="form-control" required value="<?= $row['stock_qty'] ?? 0 ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">出貨日期</label>
    <input type="date" name="ship_date" class="form-control" required value="<?= $row['ship_date'] ?? '' ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">出貨數量</label>
    <input type="number" name="ship_qty" class="form-control" required value="<?= $row['ship_qty'] ?? 0 ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">產品描述</label>
    <textarea name="product_desc" id="product_desc" class="form-control"><?= htmlspecialchars($row['product_desc'] ?? '') ?></textarea>
  </div>

  <button type="submit" class="btn btn-primary">更新產品</button>
</form>

<script>
ClassicEditor
    .create(document.querySelector('#product_desc'), {
        ckfinder: { uploadUrl: 'upload_image.php' }
    })
    .catch(error => { console.error(error); });
</script>

</body>
</html>
