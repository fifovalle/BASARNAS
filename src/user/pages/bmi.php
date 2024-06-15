<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	include('../partials/header.php');
	?>
	<link rel="stylesheet" href="../assets/css/bmi.css">
</head>

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="table-bmi">
		<h1 class="bmi-title text-center">BODY MASS INDEX (BMI)</h1>
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
						<th>Tanggal Pemeriksaan</th>
						<th>Umur</th>
						<th>Tinggi (cm)</th>
						<th>Berat (kg)</th>
						<th>Score</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center">
					<tr>
						<td>1</td>
						<td>2024-06-08</td>
						<td>25</td>
						<td>165</td>
						<td>65</td>
						<td>23</td>
						<td>Ideal</td>
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