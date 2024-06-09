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
		<div class="row">
			<!-- Sidebar for Modules -->
			<div class="col-lg-4">
				<button class="btn btn-warning d-md-none mb-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
					<i class='bx bxs-book'></i> Open Module
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
									<strong class="mb-1">Module 1</strong>
									<small>Monday</small>
								</div>
								<div class="col-10 mb-1 small">Module 1 Description.</div>
							</a>
							<a href="#" class="list-group-item" id="modul2-linked">
								<div class="d-flex w-100 align-items-center justify-content-between">
									<strong class="mb-1">Module 2</strong>
									<small>Wednesday</small>
								</div>
								<div class="col-10 mb-1 small">Module 2 Description.</div>
							</a>
							<a href="#" class="list-group-item" id="modul3-linked">
								<div class="d-flex w-100 align-items-center justify-content-between">
									<strong class="mb-1">Module 3</strong>
									<small>Monday</small>
								</div>
								<div class="col-10 mb-1 small">Module 3 Description.</div>
							</a>
						</div>
					</div>
				</div>

				<div class="d-none d-md-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 380px;">
					<a href="../pages/pembelajaran.php" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
						<span class="fs-5 fw-semibold">List Modul Pembelajaran</span>
					</a>
					<div class="list-group list-group-flush border-bottom scrollarea">
						<a href="#" class="list-group-item" id="modul1-link" >
							<div class="d-flex w-100 align-items-center justify-content-between">
								<strong class="mb-1">Module 1</strong>
								<small>Monday</small>
							</div>
							<div class="col-10 mb-1 small">Module 1 Description.</div>
						</a>
						<a href="#" class="list-group-item" id="modul2-link">
							<div class="d-flex w-100 align-items-center justify-content-between">
								<strong class="mb-1">Module 2</strong>
								<small>Wednesday</small>
							</div>
							<div class="col-10 mb-1 small">Module 2 Description.</div>
						</a>
						<a href="#" class="list-group-item" id="modul3-link">
							<div class="d-flex w-100 align-items-center justify-content-between">
								<strong class="mb-1">Module 3</strong>
								<small>Monday</small>
							</div>
							<div class="col-10 mb-1 small">Module 3 Description.</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-sm-12 py-lg-4">
				<div class="module-page" id="page-modul1" style="display: block;">
					<div class="title-module">
						<h4>Module 1</h4>
						<h3>Module 1 Title</h3>
						<h5>Monday, January 2, 2022</h5>
					</div>
					<div class="description-module" style="text-align: justify;">
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et sapiente, ut quo rem distinctio eius sunt asperiores eveniet laboriosam, facilis debitis. Quibusdam alias quo iste magni dolore, consectetur velit asperiores voluptatem. Officiis quisquam repellendus, fugiat eum, quos nihil illum ex asperiores laboriosam, corrupti porro facere reiciendis ipsam recusandae hic? Consectetur!</p>
					</div>
				</div>
				<div class="module-page" id="page-modul2" style="display: none;">
					<div class="title-module">
						<h4>Module 2</h4>
						<h3>Module 2 Title</h3>
						<h5>Wednesday, January 2, 2022</h5>
					</div>
					<div class="description-module" style="text-align: justify;">
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et sapiente, ut quo rem distinctio eius sunt asperiores eveniet laboriosam, facilis debitis. Quibusdam alias quo iste magni dolore, consectetur velit asperiores voluptatem. Officiis quisquam repellendus, fugiat eum, quos nihil illum ex asperiores laboriosam, corrupti porro facere reiciendis ipsam recusandae hic? Consectetur!</p>
					</div>
				</div>
				<div class="module-page" id="page-modul3" style="display: none;">
					<div class="title-module">
						<h4>Module 3</h4>
						<h3>Module 3 Title</h3>
						<h5>Monday, January 10, 2022</h5>
					</div>
					<div class="description-module" style="text-align: justify;">
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et sapiente, ut quo rem distinctio eius sunt asperiores eveniet laboriosam, facilis debitis. Quibusdam alias quo iste magni dolore, consectetur velit asperiores voluptatem. Officiis quisquam repellendus, fugiat eum, quos nihil illum ex asperiores laboriosam, corrupti porro facere reiciendis ipsam recusandae hic? Consectetur!</p>
					</div>
				</div>
			</div>
		</div>
	</section>
    <?php
    include('../partials/footer.php');
    ?>
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/pembelajaran.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
</body>
</html>