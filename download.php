<?php
include("db_conn.php");

$categories = [
  'router' => '路由器',
  'ap' => '無線AP',
  'firewall' => '防火牆',
  'switch' => '交換器',
  'server' => '伺服器',
];

$firmwareData = [];

foreach ($categories as $key => $label) {
  $table = "firmware_" . $key;
  $sql = "SELECT product_name, description, download_link FROM `$table` ORDER BY product_name";
  $result = mysqli_query($conn_SQL, $sql);
  $firmwareData[$key] = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $firmwareData[$key][$row['product_name']] = [
      'desc' => $row['description'],
      'link' => $row['download_link'],
    ];
  }
}

$jsonData = json_encode($firmwareData, JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="zh-Hant">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>download - 鑫瑋網路通信工程</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      padding-top: 70px;
    }
    .download-section {
      background-color: #f8f9fa;
      border-radius: 0.5rem;
      box-shadow: 0 0 10px rgb(0 0 0 / 0.1);
      padding: 20px;
      margin-bottom: 30px;
    }
    .product-info {
      margin-top: 15px;
      font-size: 0.9rem;
      color: #555;
      min-height: 60px;
    }
    .form-select {
      max-width: 400px;
      margin: auto;
    }
    h2.section-title {
      font-weight: 600;
      margin-bottom: 15px;
      border-bottom: 2px solid #0d6efd;
      padding-bottom: 5px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.html">鑫瑋網路通信工程</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">首頁</a></li>
          <li class="nav-item"><a class="nav-link" href="product.php">產品介紹</a></li>
          <li class="nav-item"><a class="nav-link active" href="download.php">檔案下載</a></li>
          <li class="nav-item"><a class="nav-link" href="service.php">客戶服務</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container mt-5">
    <section class="mb-5">
      <div class="text-center mb-4">
        <h1>Cisco 機台韌體下載</h1>
        <p>請選擇產品分類與型號，取得最新韌體下載連結與簡短介紹：</p>
      </div>

      <?php foreach ($categories as $key => $label): ?>
      <div class="download-section">
        <h2 class="section-title"><?= $label ?> (<?= ucfirst($key) ?>)</h2>
        <select id="<?= $key ?>-select" class="form-select" aria-label="選擇<?= $label ?>型號">
          <option value="" selected>請選擇<?= $label ?>型號</option>
        </select>
        <div id="<?= $key ?>-info" class="product-info"></div>
      </div>
      <?php endforeach; ?>
    </section>
  </main>

  <script>
    const firmwareData = <?= $jsonData ?>;

    function generateOptions(category) {
      if (!firmwareData[category]) return '<option value="">無相關產品</option>';
      let options = `<option value="" selected>請選擇${category}型號</option>`;
      for (const productName in firmwareData[category]) {
        options += `<option value="${productName}">${productName}</option>`;
      }
      return options;
    }

    const categories = ['router', 'ap', 'firewall', 'switch', 'server'];
    categories.forEach(cat => {
      const select = document.getElementById(cat + '-select');
      if (select) select.innerHTML = generateOptions(cat);
    });

    function setupDropdown(selectId, infoId, category) {
      const select = document.getElementById(selectId);
      const info = document.getElementById(infoId);

      select.addEventListener('change', () => {
        const val = select.value;
        if (!val) {
          info.innerHTML = "";
          return;
        }
        const data = firmwareData[category][val];
        if (data) {
          info.innerHTML = `
            <p><strong>產品介紹:</strong> ${data.desc}</p>
            <p><a href="${data.link}" target="_blank" class="btn btn-primary btn-sm">下載韌體</a></p>
          `;
        } else {
          info.innerHTML = "";
        }
      });
    }

    categories.forEach(cat => {
      setupDropdown(cat + '-select', cat + '-info', cat);
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



  <footer class="bg-dark text-white py-4">
    <div class="container text-center">
      <div class="mb-2">
        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
        <a href="#" class="text-white me-3"><i class="fab fa-github"></i></a>
        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
      </div>
      <div>
        &copy; 鑫瑋網路通信工程 | 設計：<a href="https://html5up.net" class="text-decoration-none text-light">HTML5 UP</a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>