<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="<?php echo $akarUrl ?>src/admin/uploads/<?php echo $_SESSION['Foto_Admin']; ?>" alt="image profile" class="avatar-img rounded" />
                    </div>
                    <span class="profile-username">
                        <span class="op-7">Halo,</span>
                        <span class="fw-bold"><?php echo $_SESSION['Nama_Lengkap_Admin']; ?></span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    <img src="<?php echo $akarUrl ?>src/admin/uploads/<?php echo $_SESSION['Foto_Admin']; ?>" alt="image profile" class="avatar-img rounded" />
                                </div>
                                <div class="u-text">
                                    <h4><?php echo $_SESSION['Nama_Lengkap_Admin']; ?></h4>
                                    <p class="text-muted"><?php echo $_SESSION['NIP_Admin']; ?></p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo $akarUrl ?>src/admin/pages/profile.php">Profil Saya</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo $akarUrl ?>src/admin/config/logout.php">Keluar</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>