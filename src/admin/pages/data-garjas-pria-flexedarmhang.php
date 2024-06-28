<?php include('../config/databases.php');
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
    <title>Data Garjas Pria (Flexed Arm Hang) Basarnas</title>
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
            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Data Hasil Garjas Pria (Flexed Arm Hang)</h3>
                            <h6 class="op-7 mb-2">Selamat Datang Di Halaman Data Hasil Garjas Pria (Flexed Arm Hang) Basarnas</h6>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Data Nilai Garjas Pria (Flexed Arm Hang)</h4>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#tambahGarjasPriaFlexedArmHang">
                                            <i class="fa fa-plus"></i>
                                            Tambah Nilai
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>NIP</th>
                                                    <th>Tanggal Pelaksanaan</th>
                                                    <th>Nama</th>
                                                    <th>Umur</th>
                                                    <th>Waktu Flexed Arm Hang</th>
                                                    <th>Nilai</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $garjasPriaFlexedArmHangModel = new GarjasPriaFlexedArmHang($koneksi);
                                            $garjasPriaFlexedArmHangInfo = $garjasPriaFlexedArmHangModel->tampilkanDataGarjasPriaFlexedArmHang();
                                            ?>
                                            <tbody>
                                                <?php if (!empty($garjasPriaFlexedArmHangInfo)) : ?>
                                                    <?php $nomor = 1; ?>
                                                    <?php foreach ($garjasPriaFlexedArmHangInfo as $garjasPriaFlexedArmHang) : ?>
                                                        <tr>
                                                            <td><?php echo $nomor++; ?></td>
                                                            <td><?php echo $garjasPriaFlexedArmHang['NIP_Pengguna']; ?></td>
                                                            <td><?php echo $garjasPriaFlexedArmHang['Tanggal_Pelaksanaan_Pria_Menggantung']; ?></td>
                                                            <td><?php echo $garjasPriaFlexedArmHang['Nama_Lengkap_Pengguna']; ?></td>
                                                            <td><?php echo $garjasPriaFlexedArmHang['Umur_Pengguna']; ?></td>
                                                            <td><?php echo $garjasPriaFlexedArmHang['Waktu_Menggantung_Pria']; ?></td>
                                                            <td><?php echo $garjasPriaFlexedArmHang['Nilai_Menggantung_Pria']; ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <button type="button" class="btn btn-link btn-primary btn-lg buttonGarjasPriaFlexedArmHang" data-bs-toggle="modal" data-id="<?php echo $garjasPriaFlexedArmHang['ID_Menggantung_Pria']; ?>">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-link btn-danger" onclick="konfirmasiHapusGarjasPriaFlexedArmHang(<?php echo $garjasPriaFlexedArmHang['ID_Menggantung_Pria']; ?>)">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-link btn-info buttonlihatGarjasPriaFlexedArmHang" data-bs-toggle="modal" data-id="<?php echo $garjasPriaFlexedArmHang['ID_Menggantung_Pria']; ?>">
                                                                        <i class="fa fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center text-danger fw-bolder">Tidak ada data Garjas Pria Flexed Arm Hang!</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FOOTER START -->
            <?php include('../partials/footer.php'); ?>
            <!-- FOOTER END -->
        </div>
    </div>
    <!-- CUSTOM START -->
    <?php include('../partials/custom.php'); ?>
    <!-- CUSTOM END -->

    <!-- MODALS START -->
    <?php include('../partials/modal-add-garjas-pria-flexedarmhang.php'); ?>
    <?php include('../partials/modal-edit-garjas-pria-flexedarmhang.php'); ?>
    <?php include('../partials/modal-see-garjas-pria-flexedarmhang.php'); ?>
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
    <script src="../assets/js/delete-garjas-pria-flexed-arm-hang.js"></script>
    <script src="../assets/js/value-see-garjas-pria-flexedarmhang.js"></script>
    <script src="../assets/js/value-garjas-pria-flexedarmhang.js"></script>
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