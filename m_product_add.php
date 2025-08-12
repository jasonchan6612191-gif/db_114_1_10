<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("auth_check.php");
include("db_conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = trim($_POST['product_name'] ?? '');
    $code     = trim($_POST['product_code'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $sdate    = $_POST['stock_date'] ?? '';
    $sqty     = intval($_POST['stock_qty'] ?? 0);
    $desc     = trim($_POST['product_desc'] ?? '');

    // 沒有出貨日期與數量，直接預設 0
    $shdate   = null;
    $shqty    = 0;
    $remain   = $sqty; // 進貨數量即為剩餘數量

    $sql_insert = "INSERT INTO product 
        (product_name, product_code, stock_date, stock_qty, ship_date, ship_qty, remain_qty, category, product_desc) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn_SQL, $sql_insert);
    if ($stmt === false) {
        die("❌ SQL 預處理失敗：" . mysqli_error($conn_SQL));
    }

    // ship_date 是 NULL，所以用 s 型別，ship_qty/ remain_qty 是 int
    mysqli_stmt_bind_param(
        $stmt,
        "sssisiiss",
        $name,
        $code,
        $sdate,
        $sqty,
        $shdate,
        $shqty,
        $remain,
        $category,
        $desc
    );

    if (!mysqli_stmt_execute($stmt)) {
        die("❌ 新增失敗：" . mysqli_error($conn_SQL));
    }

    mysqli_stmt_close($stmt);
    header("Location: m_product.php");
    exit;
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
<title>新增產品</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
</head>
<body class="container py-4">

<h1 class="mb-4">新增產品</h1>
<a href="m_product.php" class="btn btn-secondary mb-3">回產品管理</a>

<form method="post">
    <div class="mb-3">
        <label for="product_name" class="form-label">產品名稱</label>
        <input type="text" name="product_name" id="product_name" class="form-control" required value="<?= htmlspecialchars($_POST['product_name'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="product_code" class="form-label">產品編號</label>
        <input type="text" name="product_code" id="product_code" class="form-control" required value="<?= htmlspecialchars($_POST['product_code'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">產品分類</label>
        <select name="category" id="category" class="form-select">
            <option value="">-- 請選擇分類 --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= htmlspecialchars($cat) ?>" <?= ($cat === ($_POST['category'] ?? '')) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="stock_date" class="form-label">進貨日期</label>
        <input type="date" name="stock_date" id="stock_date" class="form-control" required value="<?= $_POST['stock_date'] ?? '' ?>">
    </div>

    <div class="mb-3">
        <label for="stock_qty" class="form-label">進貨數量</label>
        <input type="number" name="stock_qty" id="stock_qty" class="form-control" required value="<?= $_POST['stock_qty'] ?? 0 ?>">
    </div>

    <div class="mb-3">
        <label for="product_desc" class="form-label">產品描述</label>
        <textarea name="product_desc" id="product_desc" class="form-control"><?= htmlspecialchars($_POST['product_desc'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">新增產品</button>
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
