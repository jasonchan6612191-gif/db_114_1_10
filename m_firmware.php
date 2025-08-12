<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8" />
  <title>韌體分類管理</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container-sm {
      max-width: 600px;
      margin-top: 50px;
    }
    table {
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 0.5rem;
    }
    th, td {
      text-align: center;
      vertical-align: middle !important;
      font-size: 1.1rem;
    }
    a.btn-category {
      width: 100%;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="container-sm">
    <h2 class="text-center mb-4">韌體分類管理</h2>
    <table class="table table-borderless rounded">
      <tbody>
        <tr>
          <td><a href="m_firmware_router.php" class="btn btn-info btn-category">路由器韌體管理</a></td>
        </tr>
        <tr>
          <td><a href="m_firmware_ap.php" class="btn btn-info btn-category">無線 AP 韌體管理</a></td>
        </tr>
        <tr>
          <td><a href="m_firmware_switch.php" class="btn btn-info btn-category">交換器韌體管理</a></td>
        </tr>
        <tr>
          <td><a href="m_firmware_firewall.php" class="btn btn-info btn-category">防火牆韌體管理</a></td>
        </tr>
        <tr>
          <td><a href="m_firmware_server.php" class="btn btn-info btn-category">伺服器韌體管理</a></td>
        </tr>
        <tr>
          <td><a href="admin_dashboard.php" class="btn btn-secondary btn-category">返回後台首頁</a></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>

