<?php
session_start();
include("db_conn.php");

$customer_name = $_POST['customer_name'] ?? '';
$customer_email = $_POST['customer_email'] ?? '';
$customer_phone = $_POST['customer_phone'] ?? '';
$member_id = $_SESSION['member_id'] ?? null;
$total_price = 0;

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo '<div style="text-align:center; margin-top:50px;">';
    echo '<p>購物車為空。</p>';
    echo '<a href="product.php" class="btn btn-primary">回產品頁</a>';
    echo '</div>';
    exit;
}

// 計算總價
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

// 建立訂單
$insert_order = $conn_SQL->prepare("INSERT INTO orders (member_id, customer_name, customer_email, customer_phone, total_price, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$insert_order->bind_param("isssd", $member_id, $customer_name, $customer_email, $customer_phone, $total_price);

if ($insert_order->execute()) {
    $order_id = $insert_order->insert_id;

    // 建立訂單明細
    $insert_item = $conn_SQL->prepare("INSERT INTO order_items (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
    foreach ($_SESSION['cart'] as $product_id => $item) {
        $quantity = $item['quantity'];
        $unit_price = $item['price'];

        $insert_item->bind_param("iiid", $order_id, $product_id, $quantity, $unit_price);
        $insert_item->execute();
    }

    // 清空購物車
    unset($_SESSION['cart']);
} else {
    echo "訂單建立失敗：" . $conn_SQL->error;
    exit;
}
?>

<!-- 以下為訂單完成頁面 -->
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8" />
  <title>訂單完成 - 鑫瑋網路通信工程</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    /* 省略動畫CSS，與您原本相同 */
  </style>
</head>
<body>
  <div class="container text-center py-5">
    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" aria-label="訂單成功勾勾">
      <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
      <path class="checkmark__check" fill="none" d="M14 27l7 7 16-16" />
    </svg>
    <h2 class="text-success">訂單完成</h2>
    <p class="lead">感謝您的訂購，我們將儘快處理您的訂單。</p>
    <a href="index.php" class="btn btn-primary mt-3">回到首頁</a>
  </div>
</body>
</html>
