<?php
session_start();
include("db_conn.php");

// 如果購物車為空，導回購物車頁
if (empty($_SESSION['cart'])) {
    header("Location: m_product_cart.php");
    exit();
}

// 會員自動帶入資料
$member_id = $_SESSION['member_id'] ?? null;
$name = $email = $phone = '';
if ($member_id) {
    $stmt = $conn_SQL->prepare("SELECT name, email, phone FROM member WHERE id = ?");
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $stmt->bind_result($name, $email, $phone);
    $stmt->fetch();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>結帳 - 鑫瑋網路通信工程</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">🧾 結帳資訊</h2>
    <form action="m_product_order_save.php" method="post">
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">收件人姓名</label>
                <input type="text" name="name" class="form-control" required value="<?php echo htmlspecialchars($name); ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">電話</label>
                <input type="text" name="phone" class="form-control" required value="<?php echo htmlspecialchars($phone); ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required value="<?php echo htmlspecialchars($email); ?>">
            </div>
        </div>

        <h5 class="mt-4">🛒 商品列表</h5>
        <ul class="list-group mb-3">
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo htmlspecialchars($item['product_name']); ?> x <?php echo $item['quantity']; ?>
                <span>NT$ <?php echo number_format($subtotal, 2); ?></span>
            </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between">
                <strong>總金額</strong>
                <strong>NT$ <?php echo number_format($total, 2); ?></strong>
            </li>
        </ul>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">送出訂單</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
