<?php
include("auth_check.php");
include("db_conn.php");
$id = $_GET['id'];
mysqli_query($conn_SQL, "DELETE FROM member WHERE id=$id");
header("Location: m_member.php");
?>

