<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-white">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?php echo $akarUrl ?>">
			<img src="<?php echo $akarUrl ?>src/user/assets/img/LogoSimore.png" class="img-fluid" alt="...">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
			<i class='bx bx-menu bx-sm' style='color:#ffffff'></i>
		</button>
		<div class="offcanvas offcanvas-end text-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
			<div class="offcanvas-header justify-content-between">
				<img src="<?php echo $akarUrl ?>src/user/assets/img/LogoSimore.png" class="img-fluid" alt="...">
				<button class="navbar-toggler" type="button" data-bs-dismiss="offcanvas" aria-label="Close">
					<i class='bx bx-x bx-sm' style='color:#ffffff'></i>
				</button>
			</div>
			<div class="offcanvas-body">
				<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="<?php echo $akarUrl ?>" id="beranda">Beranda</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo $akarUrl ?>src/user/pages/pembelajaran.php" id="pembelajaran">Pembelajaran</a>
					</li>
					<li class="nav-item">
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="samapta">
							Samapta
						</a>
						<ul class="dropdown-menu">
							<?php
							$daftar = '
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/lari.php" id="lari">Lari 2400 M</a></li>
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/renang.php" id="renang">Renang 50 M</a></li>
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/pushup.php" id="pushup">Push Up</a></li>
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/situp1.php" id="situp1">Sit Up Kaki Lurus</a></li>
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/situp2.php" id="situp2">Sit Up Kaki Ditekuk</a></li>
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/shuttlerun.php" id="shuttlerun">Shuttle Run</a></li>
							';

							$fiturPria = '
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/chinup.php" id="chinup">Chin Up</a></li>
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/flexedarmhang.php" id="flexedarmhang">Flexed Arm Hang</a></li>
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/jalan-kaki.php" id="jalan-kaki">Jalan Kaki 5 KM</a></li>
							';

							$fiturWanita = '
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/chinup.php" id="chinup">Chinning</a></li>
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/flexedarmhang.php" id="flexedarmhang">Flexed Arm Hang</a></li>
								<li> <a class="dropdown-item" href="' . $akarUrl . 'src/user/pages/jalan-kaki.php" id="jalan-kaki">Jalan Kaki 5 KM</a></li>
							';

							echo isset($_SESSION['Jenis_Kelamin_Pengguna'])
								? ($_SESSION['Jenis_Kelamin_Pengguna'] == 'Pria' ? $daftar . $fiturPria : $daftar . $fiturWanita)
								: $daftar;
							?>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo $akarUrl ?>src/user/pages/bmi.php" id="bmi">Body Mass Index</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo $akarUrl ?>src/user/pages/kompetensi.php" id="kompetensi">Kompetensi</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="profil">
							Profil
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="<?php echo $akarUrl ?>src/user/pages/profile.php" id="pengaturan">Pengaturan</a></li>
							<li><a class="dropdown-item" href="<?php echo $akarUrl ?>src/user/pages/nilai-akhir.php" id="nilai-saya">Nilai Saya</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="<?php echo $akarUrl ?>src/user/config/logout.php" id="keluar">Keluar</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>