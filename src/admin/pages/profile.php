<?php
include('../config/databases.php');

$idSessionAdmin = $_SESSION['NIP_Admin'];
if (!isset($_SESSION['NIP_Admin'])) {
    setPesanKesalahan("Silahkan login terlebih dahulu!");
    header("Location: " . $akarUrl . "src/admin/pages/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Profil Saya</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script src="../assets/js/wenfontpages.js"></script>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/css/custom.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- SIDEBAR START -->
        <?php include('../partials/sidebar.php'); ?>
        <!-- SIDEBAR END -->
        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <h1 class="text-light text-uppercase fs-3 fw-bold">Basarnas</h1>
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                </div>
                <!-- NAVBAR START -->
                <?php include('../partials/navbar.php'); ?>
                <!-- NAVBAR END -->
            </div>
            <?php
            $idSessionAdmin = $_SESSION['NIP_Admin'];
            $adminModel = new Admin($koneksi);
            $dataAdmin = $adminModel->tampilkanAdminDenganSessionNip($idSessionAdmin);
            if (!empty($dataAdmin)) {
                $Admin = $dataAdmin[0];
            ?>
                <div class="container">
                    <div class="page-inner">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                            <div>
                                <h3 class="fw-bold mb-3">Profil Anda</h3>
                                <h6 class="op-7 mb-2">Selamat Datang Di Halaman Profil Anda!</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <img src="<?php echo $akarUrl ?>src/admin/uploads/<?php echo $Admin['Foto_Admin']; ?>" alt="avatar" class="rounded img-fluid" style="width: 160px; height: 160px;" id="profile-picture">
                                        <h5 class="my-3 mb-1 mt-4 fw-bold"><?php echo $Admin['Nama_Lengkap_Admin']; ?></h5>
                                        <p class="text-muted mb-3"><?php echo $Admin['NIP_Admin']; ?></p>
                                        <button type="button" class="btn btn-outline-dark mb-3" id="editImageButton" style="border-radius: 19px;">Sunting Gambar</button>
                                        <input type="file" class="d-none" id="profileImageInput" name="Foto_Admin" accept="image/*" onchange="uploadProfilePicture(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <form action="../config/edit-profil-admin.php" method="post" enctype="multipart/form-data">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-sm-3">
                                                    <label class="mb-0 p-3" for="nama_lengkap">Nama Lengkap :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="Nama_Lengkap_Admin" id="nama_lengkap" value="<?php echo htmlspecialchars($Admin['Nama_Lengkap_Admin']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3">
                                                    <label class="mb-0 p-3" for="no_telepon">Nomor Telepon :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="no_telepon" name="No_Telepon_Admin" value="<?php echo htmlspecialchars($Admin['No_Telepon_Admin']); ?>" required />
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3">
                                                    <label class="mb-0 p-3" for="tanggal_lahir">Tanggal Lahir :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tanggal_lahir" name="Tanggal_Lahir_Admin" value="<?php echo htmlspecialchars(date('Y-m-d', strtotime($Admin['Tanggal_Lahir_Admin']))); ?>" required />
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3">
                                                    <label class="mb-0 p-3" for="jenis_kelamin">Jenis Kelamin :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="jenis_kelamin" name="Jenis_Kelamin_Admin" required>
                                                        <option value="Pria" <?php echo ($Admin['Jenis_Kelamin_Admin'] == 'Pria') ? 'selected' : ''; ?>>Pria</option>
                                                        <option value="Wanita" <?php echo ($Admin['Jenis_Kelamin_Admin'] == 'Wanita') ? 'selected' : ''; ?>>Wanita</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3">
                                                    <label class="mb-0 p-3" for="jabatan_admin">Jabatan Admin :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="jabatan_admin" name="Jabatan_Admin" required>
                                                        <option value="Pemula" <?php echo ($Admin['Jabatan_Admin'] == 'Pemula') ? 'selected' : ''; ?>>Pemula</option>
                                                        <option value="Terampil" <?php echo ($Admin['Jabatan_Admin'] == 'Terampil') ? 'selected' : ''; ?>>Terampil</option>
                                                        <option value="Mahir" <?php echo ($Admin['Jabatan_Admin'] == 'Mahir') ? 'selected' : ''; ?>>Mahir</option>
                                                        <option value="Penyelia" <?php echo ($Admin['Jabatan_Admin'] == 'Penyelia') ? 'selected' : ''; ?>>Penyelia</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3">
                                                    <label class="mb-0 p-3" for="peran_admin">Peran Admin :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="peran_admin" name="Peran_Admin" required>
                                                        <?php if ($_SESSION['Peran_Admin'] === 'Super Admin') : ?>
                                                            <option value="Super Admin" <?php echo ($Admin['Peran_Admin'] == 'Super Admin') ? 'selected' : ''; ?>>Super Admin</option>
                                                        <?php elseif ($_SESSION['Peran_Admin'] === 'Admin') : ?>
                                                            <option value="Admin" <?php echo ($Admin['Peran_Admin'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-sm-12 text-end">
                                                    <button type="submit" class="btn btn-dark" style="border-radius: 4px;" name="Simpan">Simpan Perubahan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                echo "<p>Data Admin tidak ditemukan.</p>";
            }
            ?>
            <!-- FOOTER START -->
            <?php include('../partials/footer.php'); ?>
            <!-- FOOTER END -->
        </div>
    </div>
    <!-- CUSTOM START -->
    <?php include('../partials/custom.php'); ?>
    <!-- CUSTOM END -->

    <!-- MODALS START -->
    <!-- MODALS END -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/js/kaiadmin.min.js"></script>
    <script src="../assets/js/setting-demo.js"></script>
    <script src="../assets/js/demo.js"></script>
    <script src="../assets/js/delete-admin.js"></script>
    <script src="../assets/js/value-admin.js"></script>
    <script src="../assets/js/value-see-admin.js"></script>
    <script src="../assets/js/toogle-admin.js"></script>
    <script src="../assets/js/edit-foto-profil-admin.js"></script>
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
            $("#multi-filter-select").DataTable({
                pageLength: 5,
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            let column = this;
                            let select = $(
                                    '<select class="form-select"><option value=""></option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on("change", function() {
                                    let val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column
                                        .search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append(
                                        '<option value="' + d + '">' + d + "</option>"
                                    );
                                });
                        });
                },
            });
            $("#add-row").DataTable({
                pageLength: 5,
            });
        });
    </script>
    <!-- ALERT -->
    <?php
    include('../partials/alert.php');
    ?>
</body>

</html>