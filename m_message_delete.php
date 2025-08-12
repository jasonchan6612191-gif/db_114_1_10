<?php
include("auth_check.php");
include("db_conn.php");

$id = intval($_GET['id'] ?? 0);

if ($id > 0) {
    $sql = "DELETE FROM message WHERE id = ?";
    $stmt = mysqli_prepare($conn_SQL, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn_SQL);
        header("Location: m_message.php?msg=delete_success");
        exit;
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn_SQL);
        header("Location: m_message.php?msg=delete_fail");
        exit;
    }
}

header("Location: m_message.php");
exit;

