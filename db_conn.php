<?php

$hostname_conn_SQL = "localhost";  
$username_conn_SQL = "root";
$password_conn_SQL = "123";       
$database_conn_SQL = "db_114_1_10"; 


$conn_SQL = mysqli_connect($hostname_conn_SQL, $username_conn_SQL, $password_conn_SQL, $database_conn_SQL);


if (!$conn_SQL) {
    die("❌ 資料庫連線失敗: " . mysqli_connect_error());
}


if (!mysqli_set_charset($conn_SQL, "utf8")) {
    die("❌ 設定編碼失敗: " . mysqli_error($conn_SQL));
}
?>




