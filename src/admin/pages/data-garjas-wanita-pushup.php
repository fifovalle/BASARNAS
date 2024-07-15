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
    <title>Data Garjas Wanita (Push Up) Basarnas</title>
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
                            <h3 class="fw-bold mb-3">Data Hasil Garjas Wanita (Push Up)</h3>
                            <h6 class="op-7 mb-2">Selamat Datang Di Halaman Data Hasil Garjas Wanita (Push Up) Basarnas</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="dropdown mt-3 mb-4">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Laporan Bulanan
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="download-options"></ul>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Data Nilai Garjas Wanita (Push Up)</h4>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#tambahGarjasWanitaPushUp">
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
                                                    <th>No</th>
                                                    <th>NIP</th>
                                                    <th>Tanggal Pelaksanaan</th>
                                                    <th>Nama</th>
                                                    <th>Umur</th>
                                                    <th>Jumlah Push Up</th>
                                                    <th>Nilai</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $garjasPushUpWanitaModel = new GarjasWanitaPushUp($koneksi);
                                            $garjasPushUpWanitaInfo = $garjasPushUpWanitaModel->tampilkanDataGarjasWanitaPushUp();
                                            ?>
                                            <tbody>
                                                <?php if (!empty($garjasPushUpWanitaInfo)) : ?>
                                                    <?php $nomor = 1; ?>
                                                    <?php foreach ($garjasPushUpWanitaInfo as $garjasPushUpWanita) : ?>
                                                        <tr>
                                                            <td><?php echo $nomor++; ?></td>
                                                            <td><?php echo $garjasPushUpWanita['NIP_Pengguna']; ?></td>
                                                            <td><?php echo $garjasPushUpWanita['Tanggal_Pelaksanaan_Push_Up_Wanita']; ?></td>
                                                            <td><?php echo $garjasPushUpWanita['Nama_Lengkap_Pengguna']; ?></td>
                                                            <td><?php echo $garjasPushUpWanita['Umur_Pengguna']; ?></td>
                                                            <td><?php echo $garjasPushUpWanita['Jumlah_Push_Up_Wanita']; ?></td>
                                                            <td><?php echo $garjasPushUpWanita['Nilai_Push_Up_Wanita']; ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <button type="button" class="btn btn-link btn-primary btn-lg buttonGarjasWanitaPushUp" data-bs-toggle="modal" data-id="<?php echo $garjasPushUpWanita['ID_Wanita_Push_Up']; ?>">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-link btn-danger" onclick="konfirmasiHapusGarjasWanitaPushUp(<?php echo $garjasPushUpWanita['ID_Wanita_Push_Up']; ?>)">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-link btn-info buttonLihatGarjasWanitaPushUp" data-bs-toggle="modal" data-id="<?php echo $garjasPushUpWanita['ID_Wanita_Push_Up']; ?>">
                                                                        <i class="fa fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center text-danger fw-bolder">Tidak ada data Push Up yang ditemukan.</td>
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
    <?php include('../partials/modal-add-garjas-wanita-pushup.php'); ?>
    <?php include('../partials/modal-edit-garjas-wanita-pushup.php'); ?>
    <?php include('../partials/modal-see-garjas-wanita-pushup.php'); ?>
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
    <script src="../assets/js/delete-garjas-wanita-push-up.js"></script>
    <script src="../assets/js/value-garjas-wanita-push-up.js"></script>
    <script src="../assets/js/value-see-garjas-wanita-push-up.js"></script>
    <script src="../assets/js/laporan-bulanan-wanita-push-up.js"></script>
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
    </script>
    <!-- ALERT -->
    <?php
    include('../partials/alert.php');
    ?>
</body>

</html>