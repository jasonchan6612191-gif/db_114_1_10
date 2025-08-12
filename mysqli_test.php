<?php
echo "Loaded php.ini: " . php_ini_loaded_file() . "<br>";
echo "mysqli_connect 存在嗎？ ";

if (function_exists('mysqli_connect')) {
    echo "✅ 是的！mysqli_connect() 存在";
} else {
    echo "❌ 不存在！mysqli_connect() 被停用或沒載入";
}
?>

