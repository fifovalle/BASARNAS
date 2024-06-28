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
    <title>Data Admin Basarnas</title>
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
            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Profil Anda</h3>
                            <h6 class="op-7 mb-2">Selamat Datang Di Halaman Profil Basarnas</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="<?php echo $akarUrl ?>src/admin/uploads/<?php echo $_SESSION['Foto_Admin']; ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 100px; height: 100px;">
                                    <h5 class="my-3"><?php echo $_SESSION['Nama_Lengkap_Admin']; ?></h5>
                                    <p class="text-muted mb-1"><?php echo $_SESSION['NIP_Admin']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Nama Lengkap</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $_SESSION['Nama_Lengkap_Admin']; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Nomor Telepon</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $_SESSION['No_Telepon_Admin']; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Jenis Kelamin</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $_SESSION['Jenis_Kelamin_Admin']; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Peran Admin</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $_SESSION['Peran_Admin']; ?></p>
                                        </div>
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
    <?php include('../partials/modal-add-admin.php'); ?>
    <?php include('../partials/modal-edit-admin.php'); ?>
    <?php include('../partials/modal-see-admin.php'); ?>
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