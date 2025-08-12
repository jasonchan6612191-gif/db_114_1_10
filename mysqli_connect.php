<?php
$conn = mysqli_connect("127.0.0.1", "root", "123");

if (!$conn) {
    die("連接失敗: " . mysqli_connect_error());
} else {
    echo "MySQL 連線成功！";
}
?>

