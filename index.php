<!DOCTYPE html>
<html lang="zh-Hant">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>鑫瑋網路通信工程</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
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
          <li class="nav-item">
            <a class="btn btn-outline-light btn-sm ms-2" href="login_member.php">會員登入/註冊</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-warning btn-sm ms-2" href="login_admin.php">管理員登入</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-primary text-white text-center py-5">
    <div class="container">
      <h1 class="display-4">鑫瑋網路通信工程</h1>
      <p class="lead">我們致力於建立專業網路環境<br>企業資安更新・網路伺服架設・網站維護</p>
    </div>
  </header>

  <section id="services" class="py-5 bg-light">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100">
            <img src="images/cy01.1.jpg" class="card-img-top" alt="企業資安維護" />
            <div class="card-body">
              <h5 class="card-title">企業資安維護</h5>
              <p class="card-text">保護重要資訊財產</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100">
            <img src="images/cy02.1.jpg" class="card-img-top" alt="專業團隊" />
            <div class="card-body">
              <h5 class="card-title">專業團隊</h5>
              <p class="card-text">國家級證照人員為您服務</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100">
            <img src="images/cy03.1.jpg" class="card-img-top" alt="產品資訊" />
            <div class="card-body">
              <h5 class="card-title">產品資訊</h5>
              <p class="card-text">採用原廠機材與高規線材</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-4 mt-3">
        <div class="col-md-6">
          <div class="card h-100">
            <img src="images/cy04.1.jpg" class="card-img-top" alt="社區無線網路架設" />
            <div class="card-body">
              <h5 class="card-title">社區無線網路架設</h5>
              <p class="card-text">店面及公司的好夥伴</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card h-100">
            <img src="images/cy05.1.jpg" class="card-img-top" alt="住宅全戶網路設置" />
            <div class="card-body">
              <h5 class="card-title">住宅全戶網路設置</h5>
              <p class="card-text">有線無線任您選擇，大樓管理最便利</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-light" id="news">
    <div class="container" style="max-width:900px;">
      <h2 class="mb-4 text-center">最新消息</h2>
      <table class="table table-striped table-hover text-center align-middle">
        <thead class="table-dark">
          <tr>
            <th style="width:8%; white-space: nowrap;">編號</th>
            <th style="width:50%; text-align:left;">標題</th>
            <th style="width:20%;">日期</th>
            <th style="width:22%;">上傳人員</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include("db_conn.php");
          $sql = "SELECT id, title, content, date_posted, author FROM news ORDER BY date_posted DESC LIMIT 5";
          $result = mysqli_query($conn_SQL, $sql);
          $counter = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            $id = htmlspecialchars($row['id']);
            $title = htmlspecialchars($row['title']);
            $content = htmlspecialchars($row['content']);
            $date_posted = htmlspecialchars($row['date_posted']);
            $author = htmlspecialchars($row['author']);
          ?>
            <tr>
              <td><?= $counter ?></td>
              <td>
                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#newsModal<?= $id ?>">
                  <?= $title ?>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="newsModal<?= $id ?>" tabindex="-1" aria-labelledby="modalLabel<?= $id ?>" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?= $id ?>"><?= $title ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="關閉"></button>
                      </div>
                      <div class="modal-body">
                        <p><?= nl2br($content) ?></p>
                        <hr>
                        <small class="text-muted">
                          日期：<?= $date_posted ?> &nbsp;|&nbsp;
                          發布人員：<?= $author ?>
                        </small>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
              <td><?= $date_posted ?></td>
              <td><?= $author ?></td>
            </tr>
          <?php
            $counter++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </section>

  <footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">&copy; 2025 鑫瑋網路通信工程｜Email: jasonchan6612191@gmail.com｜電話: 0973094458｜地址: 台南市官田區工業路40號</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
