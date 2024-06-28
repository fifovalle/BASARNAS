<?php
$page = basename($_SERVER['PHP_SELF']);
include('../config/databases.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include('../partials/header.php');
  ?>
  <link rel="stylesheet" href="../assets/css/index.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include('../partials/navbar.php');
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
          <video id="myVideo" src="../assets/video/profil1.mp4" class="object-fit-cover w-100 " muted playsinline></video>
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
            <img src="../assets/img/pembelajaran.svg" class="card-img-top mx-auto d-block" alt="...">
            <h5 class="card-header text-center text-bg-transparent">PEMBELAJARAN</h5>
            <div class="card-body text-center">
              <p class="card-text">Anda dapat mengakses materi-materi yang telah disiapkan dan juga melakukan absensi secara <i>online</i> atau daring</p>
              <a href="../pages/pembelajaran.php" class="btn">cek disini</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-12 d-flex flex-column justify-content-center align-items-center ">
          <div class="card border-0" style="width: 18rem;">
            <img src="../assets/img/samapta.svg" class="card-img-top mx-auto d-block" alt="...">
            <h5 class="card-header text-center text-bg-transparent">SAMAPTA</h5>
            <div class="card-body text-center">
              <p class="card-text">Anda dapat mengakses nilai yang telah dihitung dalam tes kesemaptaan yang sudah dilakukan secara berkala.</p>
              <a href="../pages/samapta.php" class="btn">cek disini</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-12 d-flex flex-column justify-content-center align-items-center ">
          <div class="card border-0" style="width: 18rem;">
            <img src="../assets/img/kompetensi.svg" class="card-img-top mx-auto d-block" alt="...">
            <h5 class="card-header text-center">KOMPETENSI</h5>
            <div class="card-body text-center">
              <p class="card-text">Anda dapat mengakses kompetensi apa saja yang sudah anda lakukan maupun yang harus anda lakukan di waktu kedepannya.</p>
              <a href="../pages/kompetensi.php" class="btn">cek disini</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-12 d-flex flex-column justify-content-center align-items-center ">
          <div class="card border-0" style="width: 18rem;">
            <img src="../assets/img/bmi.svg" class="card-img-top mx-auto d-block" alt="...">
            <h5 class="card-header text-center text-bg-transparent">BODY MASS INDEX (BMI)</h5>
            <div class="card-body text-center">
              <p class="card-text">Anda dapat mengecek seberapa ideal rasio tubuh anda dan juga dapat mengecek apakah masuk ke kategori ideal atau tidak.</p>
              <a href="../pages/bmi.php" class="btn">cek disini</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  include('../partials/footer.php');
  ?>
  <script src="../assets/js/index.js"></script>
  <script src="../assets/js/navbar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="../assets/js/notif-monday.js"></script>
  <script src="../assets/js/notif-wednesday.js"></script>
  <!-- ALERT -->
  <?php
  include('../partials/alert.php');
  ?>
</body>

</html>