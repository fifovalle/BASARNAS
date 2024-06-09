<?php
$page = basename($_SERVER['PHP_SELF']); // Mendapatkan nama berkas yang sedang dijalankan
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('../partials/header.php');
    ?>
    <link rel="stylesheet" href="../assets/css/login.css">
    <?php if ($page == 'login.php'): ?>
    <style>
        .section-footer {
            display: none;
        }
    </style>
    <?php endif; ?>
</head>
<body>
    <section class="login-page position-relative">
        <div class="row z-index-1">
            <div class="col-lg-5 col-sm-12 text-center">
                <img src="../assets/img/login.svg" class="img-fluid web-login" alt="...">
            </div>
            <div class="col-lg-5 col-sm-12 form-login my-0">
                <div class="form-logo">
                    <img src="../assets/img/logo.png" class="img-fluid logo1" alt="...">
                    <img src="../assets/img/logo2.png" class="img-fluid logo2" alt="...">
                </div>
                <div class="form-title my-lg-5 text-center">
                    <h1 class=" ">Welcome to <b>SIMORE</b></h1>
                    <lead class=" ">Sistem Monitoring Kompetensi Rescuer</lead>
                </div>
                <form action="" method="post" class="d-flex flex-column justify-content-center align-items-center section-login">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">NIP</span>
                        <input type="text" class="form-control" placeholder="Masukkan NIP Anda" aria-label="NIP" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">Password</span>
                        <input type="password" class="form-control" placeholder="Masukkan Password Anda" aria-label="Password" aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group mb-3">
                        <svg width="350" height="120" xmlns="http://www.w3.org/2000/svg">
                            <rect width="250" height="100" x="40" y="10" rx="20" ry="20" fill="lightgray" opacity="0.6"/>
                                <text x="165" y="60" font-family="Arial" font-size="20" fill="black" text-anchor="middle" alignment-baseline="middle">
                                    12a34AZ
                                </text>
                        </svg>
                        <input type="text" class="form-control" placeholder="Masukkan Captcha Code" aria-label="Password" aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group mb-3 justify-content-center">
                        <button type="submit" class="btn btn-outline-primary text-center">MASUK</button>
                    </div>
                </form>                
            </div>
            <div class="shape-divider">
                <div class="custom-shape-divider-bottom-1717695486">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    <?php
    include('../partials/footer.php');
    ?>
</body>
</html>