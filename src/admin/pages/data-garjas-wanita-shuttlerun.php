<?php include('../config/databases.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Data Garjas Wanita (Shuttle Run) Basarnas</title>
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
                            <h3 class="fw-bold mb-3">Data Hasil Garjas Wanita (Shuttle Run)</h3>
                            <h6 class="op-7 mb-2">Selamat Datang Di Halaman Data Hasil Garjas Wanita (Shuttle Run) Basarnas</h6>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Tambah Nilai</h4>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#tambahGarjasWanitaShuttleRun">
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
                                                    <th>Nama</th>
                                                    <th>Umur</th>
                                                    <th>Waktu Shuttle Run</th>
                                                    <th>Nilai</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $garjasShuttleRunWanitaModel = new GarjasWanitaShuttleRun($koneksi);
                                            $garjasShuttleRunWanitaInfo = $garjasShuttleRunWanitaModel->tampilkanDataGarjasWanitaShuttleRun();
                                            ?>
                                            <tbody>
                                                <?php if (!empty($garjasShuttleRunWanitaInfo)) : ?>
                                                    <?php $nomor = 1; ?>
                                                    <?php foreach ($garjasShuttleRunWanitaInfo as $garjasShuttleRunWanita) : ?>
                                                        <tr>
                                                            <td><?php echo $nomor++; ?></td>
                                                            <td><?php echo $garjasShuttleRunWanita['NIP_Pengguna']; ?></td>
                                                            <td><?php echo $garjasShuttleRunWanita['Nama_Lengkap_Pengguna']; ?></td>
                                                            <td><?php echo $garjasShuttleRunWanita['Umur_Pengguna']; ?></td>
                                                            <td><?php echo $garjasShuttleRunWanita['Jumlah_Shuttle_Run_Wanita']; ?></td>
                                                            <td><?php echo $garjasShuttleRunWanita['Nilai_Shuttle_Run_Wanita']; ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                <button type="button" class="btn btn-link btn-primary btn-lg buttonGarjasWanitaShuttleRun" data-bs-toggle="modal" data-id="<?php echo $garjasShuttleRunWanita['ID_Wanita_Shuttle_Run']; ?>">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-link btn-danger" onclick="konfirmasiHapusGarjasWanitaShuttleRun(<?php echo $garjasShuttleRunWanita['ID_Wanita_Shuttle_Run']; ?>)">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-link btn-info buttonLihatGarjasWanitaShuttleRun" data-bs-toggle="modal" data-id="<?php echo $garjasShuttleRunWanita['ID_Wanita_Shuttle_Run']; ?>">
                                                                        <i class="fa fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center text-danger fw-bolder">Tidak ada data Shuttle Run yang ditemukan.</td>
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
    <?php include('../partials/modal-add-garjas-wanita-shuttlerun.php'); ?>
    <?php include('../partials/modal-edit-garjas-wanita-shuttlerun.php'); ?>
    <?php include('../partials/modal-see-garjas-wanita-shuttlerun.php'); ?>
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
    <script src="../assets/js/delete-garjas-wanita-shuttlerun.js"></script>
    <script src="../assets/js/value-garjas-wanita-shuttle-run.js"></script>
    <script src="../assets/js/value-see-garjas-wanita-shuttle-run.js"></script>
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