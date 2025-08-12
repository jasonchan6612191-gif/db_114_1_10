<?php
session_start(); 


// 初始化購物車
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// 批量加入購物車（來自 product.php）
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity']) && is_array($_POST['quantity'])) {
  foreach ($_POST['quantity'] as $product_id => $qty) {
    $qty = intval($qty);
    if ($qty <= 0) continue; // 數量為0不加入

    $product_name = $_POST['product_name'][$product_id] ?? '';
    $price = floatval($_POST['price'][$product_id] ?? 0);

    if ($product_name !== '' && $price > 0) {
      // 如果購物車已有此商品，數量累加
      if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $qty;
      } else {
        $_SESSION['cart'][$product_id] = [
          'product_name' => $product_name,
          'price' => $price,
          'quantity' => $qty,
        ];
      }
    }
  }
  header("Location: m_product_cart.php");
  exit();
}

// 更新購物車數量（購物車頁面內表單送出）
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
  foreach ($_POST['quantities'] as $product_id => $qty) {
    $qty = intval($qty);
    if ($qty <= 0) {
      unset($_SESSION['cart'][$product_id]);
    } else {
      if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] = $qty;
      }
    }
  }
  header("Location: m_product_cart.php");
  exit();
}

// 刪除商品（GET請求）
if (isset($_GET['remove'])) {
  $remove_id = $_GET['remove'];
  if (isset($_SESSION['cart'][$remove_id])) {
    unset($_SESSION['cart'][$remove_id]);
  }
  header("Location: m_product_cart.php");
  exit();
}

// 計算總金額
$total = 0;
foreach ($_SESSION['cart'] as $item) {
  $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>購物車 - 鑫瑋網路通信工程</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">🛒 購物車清單</h2>

  <?php if (empty($_SESSION['cart'])): ?>
    <p>您的購物車目前是空的。</p>
    <a href="product.php" class="btn btn-primary">去選購產品</a>
  <?php else: ?>
    <form method="post" action="m_product_cart.php">
      <table class="table table-bordered align-middle">
        <thead>
          <tr>
            <th>產品名稱</th>
            <th>單價</th>
            <th style="width:120px;">數量</th>
            <th>小計</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($_SESSION['cart'] as $id => $item): ?>
          <tr>
            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
            <td>NT$ <?php echo number_format($item['price'], 2); ?></td>
            <td>
              <input type="number" name="quantities[<?php echo $id; ?>]" value="<?php echo $item['quantity']; ?>" min="1" class="form-control" />
            </td>
            <td>NT$ <?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
            <td>
              <a href="?remove=<?php echo $id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('確定要移除此商品？')">移除</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="text-end"><strong>總計：</strong></td>
            <td colspan="2">NT$ <?php echo number_format($total, 2); ?></td>
          </tr>
        </tfoot>
      </table>
      <div class="d-flex justify-content-between">
        <a href="product.php" class="btn btn-secondary">繼續購物</a>
        <div>
          <button type="submit" name="update_cart" class="btn btn-primary me-2">更新購物車</button>
          <a href="m_product_checkout.php" class="btn btn-success">前往結帳</a>
        </div>
      </div>
    </form>
  <?php endif; ?>
</div>
</body>
</html>
