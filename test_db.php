<?php
echo "PHP OK<br>";

if (function_exists('mysqli_connect')) {
    echo "mysqli_connect() 已啟用<br>";
    $conn = mysqli_connect("127.0.0.1", "root", "123", "db_114_1_10");
    if ($conn) {
        echo "連線成功！";
    } else {
        echo "連線失敗：" . mysqli_connect_error();
    }
} else {
    echo "⚠️ mysqli_connect() 不存在！";
}
?>

