<?php
include("auth_check.php");
include("db_conn.php");

$id = $_GET['id'];
mysqli_query($conn_SQL, "DELETE FROM events WHERE id = $id");
header("Location: m_event.php");
exit;
?>
