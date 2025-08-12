<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload'])) {
    $file = $_FILES['upload'];

    // 絕對實體路徑，確保 XAMPP+Windows 正確
    $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;

    // 如果 uploads 資料夾不存在則自動建立
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // 檢查副檔名
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($ext, $allowed)) {
        echo json_encode([
            'uploaded' => 0,
            'error' => ['message' => '檔案格式不支援']
        ]);
        exit;
    }

    // 生成唯一檔名
    $filename = uniqid('prod_') . '.' . $ext;
    $targetFile = $uploadDir . $filename;

    // 將檔案從暫存轉存至目標資料夾
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        echo json_encode([
            'uploaded' => 1,
            'fileName' => $filename,
            'url' => '/db_114_1_10/uploads/' . $filename // 這是瀏覽器可訪問的 URL
        ]);
    } else {
        echo json_encode([
            'uploaded' => 0,
            'error' => ['message' => '圖片上傳失敗 - ' . $targetFile]
        ]);
    }
}
?>
