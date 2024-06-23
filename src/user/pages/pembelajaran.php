<?php
include('../config/databases.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	include('../partials/header.php');
	?>
	<link rel="stylesheet" href="../assets/css/pembelajaran.css">
</head>

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="module-section">
		<div class="row w-100">
			<div class="col-lg-4">
				<button class="btn btn-warning d-md-none mb-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
					<i class='bx bxs-book'></i> Buka Modul
				</button>
				<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
					<div class="offcanvas-header">
						<h5 class="offcanvas-title" id="offcanvasSidebarLabel">List Modul Pembelajaran</h5>
						<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
						<div class="list-group list-group-flush">
							<a href="#" class="list-group-item" id="modul1-linked">
								<div class="d-flex w-100 align-items-center justify-content-between">
									<strong class="mb-1">Absensi Hadir Hari Senin</strong>
									<small>Senin</small>
								</div>
								<div class="col-10 mb-1 small">Absensi Hadir Hari Senin</div>
							</a>
							<a href="#" class="list-group-item" id="modul2-linked">
								<div class="d-flex w-100 align-items-center justify-content-between">
									<strong class="mb-1">Absensi Hadir Hari Rabu</strong>
									<small>Rabu</small>
								</div>
								<div class="col-10 mb-1 small">Absensi Hadir Hari Rabu</div>
							</a>
							<!-- <a href="#" class="list-group-item" id="modul3-linked">
								<div class="d-flex w-100 align-items-center justify-content-between">
									<strong class="mb-1">Module 3</strong>
									<small>Senin</small>
								</div>
								<div class="col-10 mb-1 small">Module 3 Description.</div>
							</a> -->
						</div>
					</div>
				</div>
				<div class="d-none d-md-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 380px;">
					<a href="../pages/pembelajaran.php" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
						<span class="fs-5 fw-semibold">List Modul Pembelajaran</span>
					</a>
					<div class="list-group list-group-flush border-bottom scrollarea">
						<a href="#" class="list-group-item" id="modul1-link">
							<div class="d-flex w-100 align-items-center justify-content-between">
								<strong class="mb-1">Absensi Hadir Hari Senin</strong>
								<small>Senin</small>
							</div>
							<div class="col-10 mb-1 small">Absensi Hadir Hari Senin</div>
						</a>
						<a href="#" class="list-group-item" id="modul2-link">
							<div class="d-flex w-100 align-items-center justify-content-between">
								<strong class="mb-1">Absensi Hadir Hari Rabu</strong>
								<small>Rabu</small>
							</div>
							<div class="col-10 mb-1 small">Absensi Hadir Hari Rabu</div>
						</a>
						<!-- <a href="#" class="list-group-item" id="modul3-link">
							<div class="d-flex w-100 align-items-center justify-content-between">
								<strong class="mb-1">Module 3</strong>
								<small>Senin</small>
							</div>
							<div class="col-10 mb-1 small">Module 3 Description.</div>
						</a> -->
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-sm-12 py-lg-4">
				<div class="module-page w-100" id="page-modul1" style="display: block;">
					<div class="title-module">
						<h5>Absensi Hadir Hari Senin</h5>
						<h3>Absensi Kehadiran Hari Senin</h3>
					</div>
					<div class="description-module" style="text-align: justify;">
						<div class="module">
							<h3 onclick="toggleContent(this)">Tanggal 22/6/2024</h3>
							<div class="module-content">
								<div class="row w-100 mx-4">
									<div class="col-lg-12 col-sm-12">
										Deskripsi Modul Tanggal ini
									</div>
									<div class="row justify-content-end p-0">
										<div class=" modul col-lg-3 col-sm-12">
											<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modulSenin">Lihat Modul</button>
										</div>
										<div class=" hadir col-lg-3 col-sm-12">
											<button type="button" class="btn btn-success">Presensi Hadir</button>
										</div>
										<div class=" selesai col-lg-3 col-sm-12 ">
											<button type="button" class="btn btn-success">Presensi Selesai</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="module-page w-100" id="page-modul2" style="display: none;">
					<div class="title-module">
						<h5>Absensi Hadir Hari Rabu</h5>
						<h3>Absensi Kehadiran Hari Rabu</h3>
					</div>
					<div class="description-module" style="text-align: justify;">
						<div class="module">
							<h3 onclick="toggleContent(this)">Tanggal 22/6/2024</h3>
							<div class="module-content">
								<div class="row w-100 mx-4">
									<div class="col-lg-12 col-sm-12">
										Deskripsi Modul Tanggal ini
									</div>
									<div class="row justify-content-end p-0">
										<div class=" modul col-lg-3 col-sm-12">
											<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modulRabu">Lihat Modul</button>
										</div>
										<div class=" hadir col-lg-3 col-sm-12">
											<button type="button" class="btn btn-success">Presensi Hadir</button>
										</div>
										<div class=" selesai col-lg-3 col-sm-12 ">
											<button type="button" class="btn btn-success">Presensi Selesai</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="module-page" id="page-modul3" style="display: none;">
					<div class="title-module">
						<h4>Module 3</h4>
						<h3>Module 3 Title</h3>
						<h5>Monday, January 10, 2022</h5>
					</div>
					<div class="description-module" style="text-align: justify;">
						<div class="module">
							<h3 onclick="toggleContent(this)">Tanggal 22/6/2024</h3>
							<div class="module-content">
								<div class="row w-100 mx-4">
									<div class="col-lg-12 col-sm-12">
										Deskripsi Modul Tanggal ini
									</div>
									<div class="row justify-content-end p-0">
										<div class=" modul col-lg-3 col-sm-12">
											<button type="button" class="btn btn-success">Lihat Modul</button>
										</div>
										<div class=" hadir col-lg-3 col-sm-12">
											<button type="button" class="btn btn-success">Presensi Hadir</button>
										</div>
										<div class=" selesai col-lg-3 col-sm-12 ">
											<button type="button" class="btn btn-success">Presensi Selesai</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</section>
	<!-- Modal -->
	<div class="modal fade" id="modulSenin" tabindex="-1" aria-labelledby="modulSeninLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<section class="module-senin">
					<h1>Nama Modul_Senin_Tanggal Modul.pdf</h1>
				</section>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Download</button>
			</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modulRabu" tabindex="-1" aria-labelledby="modulRabuLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<section class="module-rabu">
					<h1>Nama Modul_Rabu_Tanggal Modul.pdf</h1>
				</section>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Download</button>
			</div>
			</div>
		</div>
	</div>
	<?php
	include('../partials/footer.php');
	?>
	<script src="../assets/js/navbar.js"></script>
	<script src="../assets/js/pembelajaran.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
</body>

</html>