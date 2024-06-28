<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-white">
	<div class="container-fluid">
		<a class="navbar-brand" href="../pages/index.php">
			<img src="../assets/img/LogoSimore.png" class="img-fluid" alt="...">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
			<i class='bx bx-menu bx-sm' style='color:#ffffff'></i>
		</button>
		<div class="offcanvas offcanvas-end text-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
			<div class="offcanvas-header justify-content-between">
				<img src="../assets/img/LogoSimore.png" class="img-fluid" alt="...">
				<button class="navbar-toggler" type="button" data-bs-dismiss="offcanvas" aria-label="Close">
					<i class='bx bx-x bx-sm' style='color:#ffffff'></i>
				</button>
			</div>
			<div class="offcanvas-body">
				<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="../pages/index.php" id="beranda">Beranda</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../pages/pembelajaran.php" id="pembelajaran">Pembelajaran</a>
					</li>
					<li class="nav-item">
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="samapta">
							Samapta
						</a>
						<ul class="dropdown-menu">
							<li> <a class="dropdown-item" href="../pages/lari.php" id="lari">Lari 2400 M</a></li>
							<li> <a class="dropdown-item" href="../pages/renang.php" id="renang">Renang 50 M</a></li>
							<li> <a class="dropdown-item" href="../pages/jalan-kaki.php" id="jalan-kaki">Jalan Kaki 5 KM</a></li>
							<li> <a class="dropdown-item" href="../pages/pushup.php" id="pushup">Push Up</a></li>
							<li> <a class="dropdown-item" href="../pages/situp1.php" id="situp1">Sit Up Kaki Lurus</a></li>
							<li> <a class="dropdown-item" href="../pages/situp2.php" id="situp2">Sit Up Kaki Ditekuk</a></li>
							<li> <a class="dropdown-item" href="../pages/chinup.php" id="chinup">Chin Up</a></li>
							<li> <a class="dropdown-item" href="../pages/shuttlerun.php" id="shuttlerun">Shuttle Run</a></li>
							<li> <a class="dropdown-item" href="../pages/flexedarmhang.php" id="flexedarmhang">Flexed Arm Hang</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../pages/bmi.php" id="bmi">Body Mass Index</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../pages/kompetensi.php" id="kompetensi">Kompetensi</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="profil">
							Profil
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="../pages/profile.php" id="pengaturan">Pengaturan</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="../config/logout.php" id="keluar">Keluar</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>