<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	include('../partials/header.php');
	?>
	<link rel="stylesheet" href="../assets/css/kompetensi.css">
</head>

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="table-kompetensi">
		<h1 class="kompetensi-title text-center">Kompetensi</h1>
		<div class="dropdown">
			<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				Sort By Month
			</button>
			<ul class="dropdown-menu text-center">
				<li><a class="dropdown-item" href="#">Januari</a></li>
				<li><a class="dropdown-item" href="#">Februari</a></li>
				<li><a class="dropdown-item" href="#">Maret</a></li>
				<li><a class="dropdown-item" href="#">April</a></li>
				<li><a class="dropdown-item" href="#">Mei</a></li>
				<li><a class="dropdown-item" href="#">Juni</a></li>
				<li><a class="dropdown-item" href="#">Juli</a></li>
				<li><a class="dropdown-item" href="#">Agustus</a></li>
				<li><a class="dropdown-item" href="#">September</a></li>
				<li><a class="dropdown-item" href="#">Oktober</a></li>
				<li><a class="dropdown-item" href="#">November</a></li>
				<li><a class="dropdown-item" href="#">Desember</a></li>
			</ul>
		</div>
		<div class="table-responsive-sm">
			<table class="table">
				<thead class="table-header text-center">
					<tr>
						<th>Nomor</th>
						<th>Tanggal Penerbitan Sertifikat</th>
						<th>Masa Berlaku</th>
						<th>Keterangan Sertifikat</th>
						<th>Kategori Kompetensi</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center">
					<tr>
						<td>1</td>
						<td>2024-06-08</td>
						<td>6 bulan</td>
						<td>Sertifikat Diving</td>
						<td>Rescuer Pemula</td>
						<td>
							<i class="bi bi-check-circle-fill" style="color: green; font-size: 20px;"></i>
							<i class=" d-none bi bi-x-circle-fill" style="color: red; font-size: 20px;"></i>
						</td>
						<td>
							<div class="btn-group ">
								<div class="btn btn-secondary bg-transparent border border-0 p-0 pe-2">
									<i class="bi bi-eye" style="color: black; font-size: 20px; -webkit-text-stroke-width: 0.8px;"></i>
								</div>
								<div class="btn btn-secondary bg-transparent border border-0 p-0 ps-2">
									<i class="bi bi-cloud-download" style="color: black; font-size: 20px; -webkit-text-stroke-width: 0.8px;"></i>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>
	<?php
	include('../partials/footer.php');
	?>
	<script src="../assets/js/navbar.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
</body>

</html>