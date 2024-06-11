<?php include('../config/databases.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Data Pengguna Basarnas</title>
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
                            <h3 class="fw-bold mb-3">Data Pengguna</h3>
                            <h6 class="op-7 mb-2">Selamat Datang Di Halaman Data Pengguna Basarnas</h6>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Tambah Pengguna</h4>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#tambahPengguna">
                                            <i class="fa fa-plus"></i>
                                            Tambah Pengguna
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>NIP</th>
                                                    <th>Foto</th>
                                                    <th>Nama</th>
                                                    <th>Alamat</th>
                                                    <th>Jabatan</th>
                                                    <th>Umur</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $penggunaModel = new Pengguna($koneksi);
                                                $penggunaInfo = $penggunaModel->tampilkanDataPengguna();
                                                ?>
                                                <?php if (!empty($penggunaInfo)) : ?>
                                                    <?php foreach ($penggunaInfo as $pengguna) : ?>
                                                        <tr>
                                                            <td><?php echo $pengguna['NIP_Pengguna']; ?></td>
                                                            <td>
                                                                <div class="d-flex justify-content-center">
                                                                    <img class="avatar-img rounded-circle" src="../uploads/<?php echo $pengguna['Foto_Pengguna']; ?>" alt="Nama Pengguna" style="width: 75px;  height: 75px;">
                                                                </div>
                                                            </td>
                                                            <td><?php echo $pengguna['Nama_Lengkap_Pengguna']; ?></td>
                                                            <td><?php echo $pengguna['Alamat_Pengguna']; ?></td>
                                                            <td><?php echo $pengguna['Jabatan_Pengguna']; ?></td>
                                                            <td><?php echo $pengguna['Umur_Pengguna']; ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <button type="button" class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#suntingPengguna">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-link btn-danger" data-original-title="Remove" onclick="konfirmasiHapusPengguna(<?php echo $pengguna['NIP_Pengguna']; ?>)">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-link btn-info" data-bs-toggle="modal" data-bs-target="#lihatPengguna">
                                                                        <i class="fa fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center text-danger fw-bold ">Tidak Ada Data Pengguna!</td>
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
        </div>
        <!-- FOOTER START -->
        <?php include('../partials/footer.php'); ?>
        <!-- FOOTER END -->
    </div>
    <!-- CUSTOM START -->
    <?php include('../partials/custom.php'); ?>
    <!-- CUSTOM END -->

    <!-- MODALS START -->
    <?php include('../partials/modal-add-user.php'); ?>
    <?php include('../partials/modal-edit-user.php'); ?>
    <?php include('../partials/modal-see-user.php'); ?>
    <!-- MODALS END -->
    </div>
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
    <script src="../assets/js/delete-user.js"></script>
    <script src="../assets/js/value-user.js"></script>
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
    <script>
        function togglePasswordVisibility(inputId, eyeIconId) {
            let passwordInput = document.getElementById(inputId);
            let eyeIcon = document.getElementById(eyeIconId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("bi-eye");
                eyeIcon.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("bi-eye-slash");
                eyeIcon.classList.add("bi-eye");
            }
        }

        document.getElementById('toggleKataSandiPengguna').addEventListener('click', function() {
            togglePasswordVisibility('tambahKataSandiPengguna', 'toggleKataSandiPengguna');
        });

        document.getElementById('toggleKonfirmasiKataSandiPengguna').addEventListener('click', function() {
            togglePasswordVisibility('tambahKonfirmasiKataSandiPengguna', 'toggleKonfirmasiKataSandiPengguna');
        });
    </script>
    <?php
    include('../partials/alert.php');
    ?>
</body>

</html>