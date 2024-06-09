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
    	<div class="table-responsive-sm">
    		<table class="table">
				<thead class="table-header text-center">
					<tr>
						<th>Nomor</th>
						<th>Tanggal Pemeriksaan</th>
						<th>Tinggi (cm)</th>
						<th>Berat (kg)</th>
						<th>Score</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center">
					<tr>
						<td>1</td>
						<td>2024-06-08</td>
						<td>165</td>
						<td>65</td>
						<td>23</td>
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