<?php
$page = basename($_SERVER['PHP_SELF']);
include('src/user/config/databases.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="shortcut icon" type="x-icon" href="./src/user/assets/img/logo.png">
  <link rel="stylesheet" href="./src/user/assets/css/navbar.css">
  <link rel="stylesheet" href="./src/user/assets/css/footer.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <title>BASARNAS BENGKULU</title>
  <link rel="stylesheet" href="src/user/assets/css/index.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include('src/user/partials/navbar.php');
  ?>
  <section class="carousel-profile">
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <video id="myVideo" src="src/user/assets/video/profil1.mp4" class="object-fit-cover w-100 " muted playsinline></video>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>
  <section class="section-welcome">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-sm-12 d-flex flex-column justify-content-center align-items-center">
          <h3 class="text-center">Selamat Datang di</>
            <h1 class="text-center">SIMORE</h1>
            <lead class="text-center">Sistem Monitoring Kompetensi Rescuer</lead>
        </div>
      </div>
    </div>
  </section>
  <section class="section-fitur">
    <div class="container-fluid">
      <div class="row">
        <h1 class="text-center">Fitur Yang Dimiliki</h1>
        <div class="col-lg-3 col-sm-12 d-flex flex-column justify-content-center align-items-center ">
          <div class="card border-0" style="width: 18rem;">
            <img src="src/user/assets/img/pembelajaran.svg" class="card-img-top mx-auto d-block" alt="...">
            <h5 class="card-header text-center text-bg-transparent">PEMBELAJARAN</h5>
            <div class="card-body text-center">
              <p class="card-text">Anda dapat mengakses materi-materi yang telah disiapkan dan juga melakukan absensi secara <i>online</i> atau daring</p>
              <a href="src/user/pages/pembelajaran.php" class="btn">cek disini</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-12 d-flex flex-column justify-content-center align-items-center ">
          <div class="card border-0" style="width: 18rem;">
            <img src="src/user/assets/img/samapta.svg" class="card-img-top mx-auto d-block" alt="...">
            <h5 class="card-header text-center text-bg-transparent">SAMAPTA</h5>
            <div class="card-body text-center">
              <p class="card-text">Anda dapat mengakses nilai yang telah dihitung dalam tes kesemaptaan yang sudah dilakukan secara berkala.</p>
              <a href="src/user/pages/samapta.php" class="btn">cek disini</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-12 d-flex flex-column justify-content-center align-items-center ">
          <div class="card border-0" style="width: 18rem;">
            <img src="src/user/assets/img/kompetensi.svg" class="card-img-top mx-auto d-block" alt="...">
            <h5 class="card-header text-center">KOMPETENSI</h5>
            <div class="card-body text-center">
              <p class="card-text">Anda dapat mengakses kompetensi apa saja yang sudah anda lakukan maupun yang harus anda lakukan di waktu kedepannya.</p>
              <a href="src/user/pages/kompetensi.php" class="btn">cek disini</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-12 d-flex flex-column justify-content-center align-items-center ">
          <div class="card border-0" style="width: 18rem;">
            <img src="src/user/assets/img/bmi.svg" class="card-img-top mx-auto d-block" alt="...">
            <h5 class="card-header text-center text-bg-transparent">BODY MASS INDEX (BMI)</h5>
            <div class="card-body text-center">
              <p class="card-text">Anda dapat mengecek seberapa ideal rasio tubuh anda dan juga dapat mengecek apakah masuk ke kategori ideal atau tidak.</p>
              <a href="src/user/pages/bmi.php" class="btn">cek disini</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  include('src/user/partials/footer.php');
  ?>
  <script src="src/user/assets/js/index.js"></script>
  <script src="src/user/assets/js/navbar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="src/user/assets/js/notif-monday.js"></script>
  <script src="src/user/assets/js/notif-wednesday.js"></script>
  <!-- ALERT -->
  <?php
  include('src/user/partials/alert.php');
  ?>
</body>

</html>