<?php
include("auth_check.php");
include("db_conn.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: m_news.php");
    exit;
}

$id = intval($_GET['id']);

$sql = "DELETE FROM news WHERE id = ?";
$stmt = mysqli_prepare($conn_SQL, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: m_news.php");
exit;
?>
