<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>產品介紹 - 鑫瑋網路通信工程</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .carousel-item img {
      max-height: 200px;
      width: auto;
      margin-left: auto;
      margin-right: auto;
      display: block;
      object-fit: contain;
      cursor: pointer;
    }
    #imageModal .modal-dialog {
      max-width: 600px;
      max-height: 500px;
    }
    #imageModal img {
      width: 100%;
      height: auto;
      display: block;
      margin: 0 auto;
      border-radius: 8px;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">鑫瑋網路通信工程</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="index.php">首頁</a></li>
          <li class="nav-item"><a class="nav-link" href="product.php">產品介紹</a></li>
          <li class="nav-item"><a class="nav-link" href="download.php">檔案下載</a></li>
          <li class="nav-item"><a class="nav-link" href="service.php">客戶服務</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-primary text-white text-center py-5">
    <div class="container">
      <h1 class="display-4">產品介紹</h1>
      <p class="lead">探索我們提供的各項專業網路通信產品與服務</p>
    </div>
  </header>

  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100">
            <img src="images/internet08.jpg" class="card-img-top img-fluid" alt="企業資安維護">
            <div class="card-body">
              <h5 class="card-title">企業資安維護</h5>
              <p class="card-text">保護資訊資產，提升企業資安防護。</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100">
            <img src="images/internet01.jpg" class="card-img-top img-fluid" alt="專業團隊">
            <div class="card-body">
              <h5 class="card-title">專業團隊</h5>
              <p class="card-text">由擁有國家級證照的技術人員為您服務。</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100">
            <img src="images/internet09.jpg" class="card-img-top img-fluid" alt="產品資訊">
            <div class="card-body">
              <h5 class="card-title">產品資訊</h5>
              <p class="card-text">選用高品質原廠設備與高規線材。</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-dark">
    <div class="container">
      <h2 class="text-center text-white mb-4">產品圖片展示</h2>
      <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/cable-1.jpg" class="d-block w-100" alt="cable-1">
          </div>
          <div class="carousel-item">
            <img src="images/cable-2.jpg" class="d-block w-100" alt="cable-2">
          </div>
          <div class="carousel-item">
            <img src="images/cable-3.jpg" class="d-block w-100" alt="cable-3">
          </div>
          <div class="carousel-item">
            <img src="images/cable-4.jpg" class="d-block w-100" alt="cable-4">
          </div>
          <div class="carousel-item">
            <img src="images/cable-5.jpg" class="d-block w-100" alt="cable-5">
          </div>
          <div class="carousel-item">
            <img src="images/cisco-1.jpg" class="d-block w-100" alt="cisco-1">
          </div>
          <div class="carousel-item">
            <img src="images/cisco-2.jpg" class="d-block w-100" alt="cisco-2">
          </div>
          <div class="carousel-item">
            <img src="images/cisco-3.jpg" class="d-block w-100" alt="cisco-3">
          </div>
          <div class="carousel-item">
            <img src="images/cisco-4.jpg" class="d-block w-100" alt="cisco-4">
          </div>
          <div class="carousel-item">
            <img src="images/cisco-5.jpg" class="d-block w-100" alt="cisco-5">
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">上一張</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">下一張</span>
        </button>
      </div>
    </div>
  </section>

  <footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">&copy; 2025 鑫瑋網路通信工程｜設計：HTML5 UP</p>
  </footer>

  <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content position-relative">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        <img src="" alt="大圖" class="modal-img rounded" />
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('#productCarousel .carousel-item img').forEach(img => {
      img.style.cursor = 'pointer';
      img.addEventListener('click', () => {
        const modalImg = document.querySelector('#imageModal .modal-img');
        modalImg.src = img.src;
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
      });
    });
  </script>
</body>
</html>
