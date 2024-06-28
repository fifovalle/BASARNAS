<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
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
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item <?php echo apakahAktif('src/admin/') ? 'active' : ''; ?>">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Beranda</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo apakahAktif('src/admin/') ? 'show' : ''; ?>" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/">
                                    <span class="sub-item">Halaman Utama</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Kumpulan Data</h4>
                </li>
                <li class="nav-item <?php echo apakahAktif('src/admin/pages/data-admin.php') || apakahAktif('src/admin/pages/data-user.php') ? 'active' : ''; ?>">
                    <a data-bs-toggle="collapse" href="#anggotaAdmin">
                        <i class="fas fa-layer-group"></i>
                        <p>Anggota & Admin</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo apakahAktif('src/admin/pages/data-admin.php') || apakahAktif('src/admin/pages/data-user.php') ? 'show' : ''; ?>" id="anggotaAdmin">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-admin.php">
                                    <span class="sub-item">Admin</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-user.php">
                                    <span class="sub-item">Anggota</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?php echo apakahAktif('src/admin/pages/data-garjas-pria-pushup.php') || apakahAktif('src/admin/pages/data-garjas-pria-situp1.php') || apakahAktif('src/admin/pages/data-garjas-pria-shuttlerun.php') || apakahAktif('src/admin/pages/data-garjas-pria-flexedarmhang.php') || apakahAktif('src/admin/pages/data-garjas-pria-chinup.php') || apakahAktif('src/admin/pages/data-garjas-pria-situp2.php') ? 'active' : ''; ?>">
                    <a data-bs-toggle="collapse" href="#garjasPria">
                        <i class="fas fa-layer-group"></i>
                        <p>Garjas Pria</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo apakahAktif('src/admin/pages/data-garjas-pria-pushup.php') || apakahAktif('src/admin/pages/data-garjas-pria-situp1.php') || apakahAktif('src/admin/pages/data-garjas-pria-shuttlerun.php') || apakahAktif('src/admin/pages/data-garjas-pria-flexedarmhang.php') || apakahAktif('src/admin/pages/data-garjas-pria-chinup.php') || apakahAktif('src/admin/pages/data-garjas-pria-situp2.php') ? 'show' : ''; ?>" id="garjasPria">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-pria-pushup.php">
                                    <span class="sub-item">Push Up</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-pria-situp1.php">
                                    <span class="sub-item">Sit Up Kaki Lurus</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-pria-shuttlerun.php">
                                    <span class="sub-item">Shuttle Run</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-pria-flexedarmhang.php">
                                    <span class="sub-item">Flexed Arm Hang</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-pria-chinup.php">
                                    <span class="sub-item">Chin Up</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-pria-situp2.php">
                                    <span class="sub-item">Sit Up Kaki Ditekuk</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?php echo apakahAktif('src/admin/pages/data-garjas-wanita-pushup.php') || apakahAktif('src/admin/pages/data-garjas-wanita-situp1.php') || apakahAktif('src/admin/pages/data-garjas-wanita-shuttlerun.php') || apakahAktif('src/admin/pages/data-garjas-wanita-chinup.php') || apakahAktif('src/admin/pages/data-garjas-wanita-situp2.php') ? 'active' : ''; ?>">
                    <a data-bs-toggle="collapse" href="#garjasWanita">
                        <i class="fas fa-layer-group"></i>
                        <p>Garjas Wanita</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo apakahAktif('src/admin/pages/data-garjas-wanita-pushup.php') || apakahAktif('src/admin/pages/data-garjas-wanita-situp1.php') || apakahAktif('src/admin/pages/data-garjas-wanita-shuttlerun.php') || apakahAktif('src/admin/pages/data-garjas-wanita-chinup.php') || apakahAktif('src/admin/pages/data-garjas-wanita-situp2.php') ? 'show' : ''; ?>" id="garjasWanita">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-wanita-pushup.php">
                                    <span class="sub-item">Push Up</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-wanita-situp1.php">
                                    <span class="sub-item">Sit Up Kaki Lurus</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-wanita-shuttlerun.php">
                                    <span class="sub-item">Shuttle Run</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-wanita-chinup.php">
                                    <span class="sub-item">Chin Up</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-wanita-situp2.php">
                                    <span class="sub-item">Sit Up Kaki Ditekuk</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?php echo apakahAktif('src/admin/pages/data-garjas-pria-renang.php') || apakahAktif('src/admin/pages/data-garjas-wanita-renang.php') ? 'active' : ''; ?>">
                    <a data-bs-toggle="collapse" href="#tesRenang">
                        <i class="fas fa-layer-group"></i>
                        <p>Tes Renang</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo apakahAktif('src/admin/pages/data-garjas-pria-renang.php') || apakahAktif('src/admin/pages/data-garjas-wanita-renang.php') ? 'show' : ''; ?>" id="tesRenang">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-pria-renang.php">
                                    <span class="sub-item">Pria</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-wanita-renang.php">
                                    <span class="sub-item">Wanita</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?php echo apakahAktif('src/admin/pages/data-garjas-pria-lari.php') || apakahAktif('src/admin/pages/data-garjas-wanita-lari.php') ? 'active' : ''; ?>">
                    <a data-bs-toggle="collapse" href="#tesLari">
                        <i class="fas fa-layer-group"></i>
                        <p>Tes Lari</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo apakahAktif('src/admin/pages/data-garjas-pria-lari.php') || apakahAktif('src/admin/pages/data-garjas-wanita-lari.php') ? 'show' : ''; ?>" id="tesLari">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-pria-lari.php">
                                    <span class="sub-item">Pria</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-wanita-lari.php">
                                    <span class="sub-item">Wanita</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?php echo apakahAktif('src/admin/pages/data-garjas-pria-jalan.php') || apakahAktif('src/admin/pages/data-garjas-wanita-jalan.php') ? 'active' : ''; ?>">
                    <a data-bs-toggle="collapse" href="#tesJalan">
                        <i class="fas fa-layer-group"></i>
                        <p>Tes Jalan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo apakahAktif('src/admin/pages/data-garjas-pria-jalan.php') ? 'show' : ''; ?>" id="tesJalan">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-garjas-pria-jalan.php">
                                    <span class="sub-item">Pria</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?php echo apakahAktif('src/admin/pages/data-beginner-competence.php') || apakahAktif('src/admin/pages/data-skilled-competence.php') || apakahAktif('src/admin/pages/data-advanced-competence.php') ? 'active' : ''; ?>">
                    <a data-bs-toggle="collapse" href="#kompetensi">
                        <i class="fas fa-layer-group"></i>
                        <p>Kompetensi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo apakahAktif('src/admin/pages/data-beginner-competence.php') || apakahAktif('src/admin/pages/data-skilled-competence.php') || apakahAktif('src/admin/pages/data-advanced-competence.php') ? 'show' : ''; ?>" id="kompetensi">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-beginner-competence.php">
                                    <span class="sub-item">Pemula</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-skilled-competence.php">
                                    <span class="sub-item">Terampil</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-advanced-competence.php">
                                    <span class="sub-item">Mahir</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?php echo apakahAktif('src/admin/pages/data-modul.php') || apakahAktif('src/admin/pages/data-absence.php') || apakahAktif('src/admin/pages/data-bmi.php') ? 'active' : ''; ?>">
                    <a data-bs-toggle="collapse" href="#data">
                        <i class="fas fa-layer-group"></i>
                        <p>Data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo apakahAktif('src/admin/pages/data-modul.php') || apakahAktif('src/admin/pages/data-absence.php') || apakahAktif('src/admin/pages/data-bmi.php') ? 'show' : ''; ?>" id="data">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-modul.php">
                                    <span class="sub-item">Modul</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-absence.php">
                                    <span class="sub-item">Absensi</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $akarUrl ?>src/admin/pages/data-bmi.php">
                                    <span class="sub-item">BMI</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>