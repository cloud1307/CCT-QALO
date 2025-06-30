<?php include '../include/header.php'; ?>
<?php include '../include/scripts.php'; ?>
<body>

	<!-- Main navbar -->
		<?php include '../include/mainNavBar.php'; ?>
	<!-- /main navbar -->

	<!-- Page content -->
	<div class="page-content">
		<!-- Main sidebar -->
			<?php include '../include/sidebar.php'; ?>
		<!-- /Main sidebar -->

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">
				<!-- Page header -->
				<div class="page-header page-header-light shadow">
					<div class="page-header-content d-lg-flex">
						<div class="d-flex">
							<h4 class="page-title mb-0">
								Home - <span class="fw-normal">Dashboard</span>
							</h4>
						</div>						
					</div>

					<div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="index.html" class="breadcrumb-item"><i class="ph-house"></i></a>
								<a href="#" class="breadcrumb-item">Home</a>
								<span class="breadcrumb-item active">Dashboard</span>
							</div>
						</div>						
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">
					<!-- Dashboard content -->
					<div class="row">
						<div class="col-xl-12">	
							<!-- Quick stats boxes -->
							<div class="row">
								<div class="col-lg-3">
									<!-- Members online -->
									<div class="card bg-teal text-white">
										<div class="card-body">
											<div class="d-flex">
												<h3 class="mb-0">3,450</h3>
												<span class="badge bg-black bg-opacity-50 rounded-pill align-self-center ms-auto">+53,6%</span>
						                	</div>
						                	
						                	<div>
												Members online
												<div class="fs-sm opacity-75">489 avg</div>
											</div>
										</div>

										<div class="rounded-bottom overflow-hidden mx-3" id="members-online"></div>
									</div>
									<!-- /members online -->

								</div>

								<div class="col-lg-3">

									<!-- Members online -->
									<div class="card bg-teal text-white">
										<div class="card-body">
											<div class="d-flex">
												<h3 class="mb-0">3,450</h3>
												<span class="badge bg-black bg-opacity-50 rounded-pill align-self-center ms-auto">+53,6%</span>
						                	</div>
						                	
						                	<div>
												Members online
												<div class="fs-sm opacity-75">489 avg</div>
											</div>
										</div>

										<div class="rounded-bottom overflow-hidden mx-3" id="members-online"></div>
									</div>
									<!-- /members online -->
								</div>

								<div class="col-lg-3">
									<!-- Current server load -->
									<div class="card bg-pink text-white">
										<div class="card-body">
											<div class="d-flex align-items-center">
												<h3 class="mb-0">49.4%</h3>
												<div class="dropdown d-inline-flex ms-auto">
													<a href="#" class="text-white d-inline-flex align-items-center" >
														<i class="ph-gear"></i>
													</a>
													
						                		</div>
						                	</div>
						                	
						                	<div>
												Current server load
												<div class="fs-sm opacity-75">34.6% avg</div>
											</div>
										</div>

										<div class="rounded-bottom overflow-hidden" id="server-load"></div>
									</div>
									<!-- /current server load -->
								</div>

								<div class="col-lg-3">
									<!-- Today's revenue -->
									<div class="card bg-primary text-white">
										<div class="card-body">
											<div class="d-flex align-items-center">
												<h3 class="mb-0">$18,390</h3>
												<div class="ms-auto">
							                		<a class="text-white" data-card-action="reload">
							                			<i class="ph-arrows-clockwise"></i>
							                		</a>
							                	</div>
						                	</div>
						                	
						                	<div>
												Today's revenue
												<div class="fs-sm opacity-75">$37,578 avg</div>
											</div>
										</div>

										<div class="rounded-bottom overflow-hidden" id="today-revenue"></div>
									</div>
									<!-- /today's revenue -->
								</div>
							</div>
							<!-- /quick stats boxes -->
						</div>						
					</div>
					<!-- /dashboard content -->
				</div>
				<!-- /content area -->
				<!-- Footer -->
				<?php include '../include/footer.php'; ?>
				<!-- /footer -->
			</div>
			<!-- /inner content -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html>