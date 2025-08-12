<!DOCTYPE html>
<html lang="zh-Hant">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>鑫瑋網路通信工程</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <style>
    .bg-card {
      background-size: cover;
      background-position: center;
      color: white;
      text-shadow: 1px 1px 2px black;
      height: 250px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 0.5rem;
    }

    .scroll-gallery {
      display: flex;
      overflow-x: auto;
      gap: 1rem;
      scroll-behavior: smooth;
      padding-bottom: 1rem;
      white-space: nowrap;
    }

    .scroll-gallery img {
      max-height: 200px;
      flex-shrink: 0;
      border-radius: 8px;
    }

    .scroll-gallery::-webkit-scrollbar {
      height: 8px;
    }

    .scroll-gallery::-webkit-scrollbar-thumb {
      background-color: #888;
      border-radius: 4px;
    }

    .scroll-gallery::-webkit-scrollbar-track {
      background-color: #f1f1f1;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">鑫瑋網路通信工程</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">首頁</a></li>
          <li class="nav-item"><a class="nav-link" href="product.php">產品介紹</a></li>
          <li class="nav-item"><a class="nav-link" href="download.php">檔案下載</a></li>
          <li class="nav-item"><a class="nav-link active" href="service.php">客戶服務</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="py-5 bg-light" id="courses">
    <div class="container">
      <h2 class="text-center mb-4">資安課程介紹</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="bg-card" style="background-image: url('images/cy03.1.jpg');">
            <div>
              <h5>基礎資安防護</h5>
              <p class="small">密碼管理、防詐技巧、資安意識</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="bg-card" style="background-image: url('images/cy08.jpg');">
            <div>
              <h5>企業資安強化</h5>
              <p class="small">防火牆、IDS、資安政策</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="bg-card" style="background-image: url('images/cy09.jpg');">
            <div>
              <h5>進階駭客與防禦</h5>
              <p class="small">紅隊模擬、藍隊策略</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5" id="services">
    <div class="container">
      <h2 class="text-center mb-4">工程師服務</h2>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="bg-card" style="background-image: url('images/cy10.jpg'); height: 200px;">
            <div>
              <h5>網路建置與維護</h5>
              <p class="small">網路規劃、布線、防火牆設定</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="bg-card" style="background-image: url('images/cy11.jpg'); height: 200px;">
            <div>
              <h5>資安防護服務</h5>
              <p class="small">健檢、滲透測試、事件應變</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-light" id="gallery">
    <div class="container">
      <h2 class="text-center mb-4">客戶員工訓練</h2>
      <div class="scroll-gallery px-2">
        <img src="images/cy12.jpg" alt="展示圖1" />
        <img src="images/cy13.jpg" alt="展示圖2" />
        <img src="images/cy14.jpg" alt="展示圖3" />
        <img src="images/cy15.jpg" alt="展示圖4" />
        <img src="images/cy16.jpg" alt="展示圖5" />
      </div>
    </div>
  </section>

  <section class="py-5" id="contact">
    <div class="container">
      <h2 class="text-center mb-4">聯絡我們</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="mb-4">
            <h5><i class="fas fa-envelope me-2"></i>電子信箱</h5>
            <a href="mailto:jasonchan6612191@gmail.com">jasonchan6612191@gmail.com</a>
          </div>
          <div class="mb-4">
            <h5><i class="fas fa-phone me-2"></i>聯絡電話</h5>
            <p>0973094458</p>
          </div>
          <div>
            <h5><i class="fas fa-home me-2"></i>公司地址</h5>
            <address>
              台南市官田區工業路40號
              <a href="https://www.google.com/maps?q=台南市官田區工業路40號" target="_blank" class="ms-2 text-decoration-none text-primary">
                <i class="fas fa-map-location-dot"></i> 查看地圖
              </a>
            </address>
          </div>
        </div>

        <div class="col-md-6">
          <form method="post" action="save_message.php">
            <div class="mb-3">
              <label for="name" class="form-label">您的大名</label>
              <input type="text" class="form-control" id="name" name="name" required />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">電子信箱</label>
              <input type="email" class="form-control" id="email" name="email" required />
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">留言內容</label>
              <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">送出留言</button>
              <button type="reset" class="btn btn-outline-secondary ms-2">清除</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">&copy; 2025 鑫瑋網路通信工程</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
