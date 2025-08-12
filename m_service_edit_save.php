<?php
include("auth_check.php");
include("db_conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $reply = trim($_POST['reply'] ?? '');

    if ($id > 0) {
        $sql = "UPDATE message SET reply = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn_SQL, $sql);
        mysqli_stmt_bind_param($stmt, "si", $reply, $id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn_SQL);
            header("Location: m_service.php?msg=edit_success");
            exit;
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($conn_SQL);
            header("Location: m_service.php?msg=edit_fail");
            exit;
        }
    }
}

header("Location: m_service.php");
exit;
