<?php
include('../config/databases.php');

$idSessionPengguna = $_SESSION['NIP_Pengguna'];
if (!isset($_SESSION['NIP_Pengguna'])) {
  setPesanKesalahan("Silahkan login terlebih dahulu!");
  header("Location: " . $akarUrl . "src/user/pages/login.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include('../partials/header.php');
  ?>
  <link rel="stylesheet" href="../assets/css/profile.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include('../partials/navbar.php');
  ?>
  <section class="section-profile">
    <?php
    $idSessionPengguna = $_SESSION['NIP_Pengguna'];
    $penggunaModel = new Pengguna($koneksi);
    $dataPengguna = $penggunaModel->tampilkanPenggunaDenganSessionNip($idSessionPengguna);
    if (!empty($dataPengguna)) {
      $pengguna = $dataPengguna[0];
    ?>
      <div class="row w-100 profile-menu">
        <div class="col-lg-4 col-sm-12 text-center profile-setting">
          <div class="profile-picture-container">
            <img src="<?php echo $akarUrl ?>src/admin/uploads/<?php echo $pengguna['Foto_Pengguna']; ?>" class="img-thumbnail profile-picture" alt="Profile Picture">
            <form id="form-edit-profile" action="../config/edit-foto-profil-user.php" method="post" enctype="multipart/form-data">
              <input type="file" name="Foto_Pengguna" id="profile-upload" accept="image/*" style="display: none;" onchange="uploadProfilePicture(event)">
              <a href="#" id="change-profile-link">
                <img src="../assets/img/change-profile.svg" class="img-fluid change-profile" alt="Change Profile">
              </a>
            </form>
          </div>
          <div class="form">
            <input type="file" id="profile-upload" accept="image/*" style="display: none;" onchange="uploadProfilePicture(event)">
          </div>
        </div>
        <div class="col-lg-7 col-sm-12 form-profile">
          <form action="../config/edit-profil-user.php" class="row g-3 text-center" method="post">
            <div class="col-lg-6 col-sm-12">
              <label for="validationCustom01" class="form-label">NIP</label>
              <input type="text" class="form-control" name="NIP_Pengguna" value="<?php echo htmlspecialchars($pengguna['NIP_Pengguna']); ?>" readonly>
            </div>
            <div class="col-lg-6 col-sm-12">
              <label for="validationCustom02" class="form-label">Nama Pengguna</label>
              <input type="text" class="form-control" name="Nama_Lengkap_Pengguna" value="<?php echo htmlspecialchars($pengguna['Nama_Lengkap_Pengguna']); ?>">
            </div>
            <div class="col-lg-6 col-sm-12">
              <label for="validationCustom02" class="form-label">Tanggal Lahir Pengguna</label>
              <input type="date" class="form-control" name="Tanggal_Lahir_Pengguna" value="<?php echo htmlspecialchars($pengguna['Tanggal_Lahir_Pengguna']); ?>">
            </div>
            <div class="col-lg-6 col-sm-12">
              <label for="validationCustom02" class="form-label">Umur Pengguna</label>
              <input type="number" class="form-control" name="Umur_Pengguna" value="<?php echo htmlspecialchars($pengguna['Umur_Pengguna']); ?>">
            </div>
            <div class="col-lg-6 col-sm-12">
              <label for="validationCustom02" class="form-label">Jenis Kelamin Pengguna</label>
              <select name="Jenis_Kelamin_Pengguna" id="validationCustom02" name="Jenis_Kelamin_Pengguna" class="form-select">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Pria" <?php echo ($pengguna['Jenis_Kelamin_Pengguna'] == 'Pria') ? 'selected' : ''; ?>>Pria</option>
                <option value="Wanita" <?php echo ($pengguna['Jenis_Kelamin_Pengguna'] == 'Wanita') ? 'selected' : ''; ?>>Wanita</option>
              </select>
            </div>
            <div class="col-lg-6 col-sm-12">
              <label for="validationCustom02" class="form-label">No.Telepon Pengguna</label>
              <input type="tel" class="form-control" name="No_Telepon_Pengguna" value="<?php echo htmlspecialchars($pengguna['No_Telepon_Pengguna']); ?>">
            </div>
            <div class="col-lg-12 col-sm-12">
              <button type="submit" class="btn btn-primary px-4" name="Simpan"><i class='bx bx-check-double pe-1'></i>Simpan</button>
            </div>
          </form>
        </div>
      </div>
    <?php
    } else {
      echo "<p>Data pengguna tidak ditemukan.</p>";
    }
    ?>
  </section>
  <?php
  include('../partials/footer.php');
  ?>
  <script src="../assets/js/navbar.js"></script>
  <script src="../assets/js/profile.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
  <!-- ALERT -->
  <?php
  include('../partials/alert.php');
  ?>
</body>

</html>