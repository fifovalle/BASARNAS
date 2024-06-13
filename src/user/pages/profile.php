<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include('../partials/header.php');
  ?>
  <link rel="stylesheet" href="../assets/css/profile.css">
</head>

<body>
  <?php
  include('../partials/navbar.php');
  ?>
  <section class="section-profile">
    <div class="row w-100 profile-menu">
      <div class="col-lg-4 col-sm-12 text-center profile-setting">
        <div class="profile-picture-container">
          <img src="../assets/img/tester.jpg" class="img-thumbnail profile-picture" alt="Profile Picture">
          <a href="" id="change-profile-link">
            <img src="../assets/img/change-profile.svg" class="img-fluid change-profile" alt="Change Profile">
          </a>
        </div>
        <div class="form">
          <input type="file" id="profile-upload" accept="image/*" style="display: none;" onchange="uploadProfilePicture(event)">
        </div>
      </div>
      <div class="col-lg-7 col-sm-12 form-profile">
        <form class="row g-3 text-center" method="post">
          <div class="col-lg-6 col-sm-12">
            <label for="validationCustom01" class="form-label">NIP</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Awal">
          </div>
          <div class="col-lg-6 col-sm-12">
            <label for="validationCustom02" class="form-label">Nama Pengguna</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Pengguna">
          </div>
          <div class="col-lg-6 col-sm-12">
            <label for="validationCustom02" class="form-label">Tanggal Lahir Pengguna</label>
            <input type="text" class="form-control" placeholder="Masukkan Tanggal Lahir Pengguna">
          </div>
          <div class="col-lg-6 col-sm-12">
            <label for="validationCustom02" class="form-label">Umur Pengguna</label>
            <input type="number" class="form-control" placeholder="Masukkan Umur Pengguna">
          </div>
          <div class="col-lg-6 col-sm-12">
            <label for="validationCustom02" class="form-label">Jenis Kelamin Pengguna</label>
            <input type="text" class="form-control" placeholder="Masukkan Jenis Kelamin Pengguna">
          </div>
          <div class="col-lg-6 col-sm-12">
            <label for="validationCustom02" class="form-label">No.Telepon Pengguna</label>
            <input type="number" class="form-control" placeholder="Masukkan No.Telepon Pengguna">
          </div>
          <div class="col-lg-12 col-sm-12 ">
            <label for="validationCustom02" class="form-label">Alamat Pengguna</label>
            <textarea type="text" class="form-control" placeholder="Masukkan Alamat Pengguna" rows="4" cols="50"></textarea>
          </div>
          <div class="col-lg-12 col-sm-12">
            <button type="button" class="btn btn-primary px-4"><i class='bx bx-check-double pe-1'></i>Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </section>
  <?php
  include('../partials/footer.php');
  ?>
  <script src="../assets/js/navbar.js"></script>
  <script src="../assets/js/profile.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
</body>

</html>