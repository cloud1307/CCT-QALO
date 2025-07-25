<?php 
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

include '../include/header.php'; 
?>
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
								<a href="dashboard.php" class="breadcrumb-item">Home</a>
								<span class="breadcrumb-item active">List of Major</span>
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
								<!-- hover rows -->
								<div class="card">									
									<div class="card-header">
										<div class="card-title modal-footer justify-content-between">
												<h5 class="mb-0">List of Major</h5>												
												<?php	include '../modal/modal.php'; ?>
												<a href="#modal_major_course" class="btn btn-outline-success" data-bs-toggle="modal"><i class="ph-buildings me-2"></i> Add Major Course</a> 
										</div>								
									</div>

									<table class="table datatable-basic table-hover">
										<thead>
											<tr>
												<th>Major Course</th>
												<!-- <th>Major Code</th>												 -->
												<th>Status</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>BACHELOR OF SCIENCE IN SECONDARY EDUCATION</td>
												<!-- <td>BSE</td>												 -->
												<td><span class="badge bg-success bg-opacity-10 text-success">Active</span></td>
												<td class="text-center">
													<div class="d-inline-flex">
														<div class="dropdown">
															<a href="#" class="text-body" data-bs-toggle="dropdown">
																<i class="ph-list"></i>
															</a>

															<div class="dropdown-menu dropdown-menu-end">
																<a href="#" class="dropdown-item">
																	<i class="ph-pencil me-2"></i>
																	Edit
																</a>
																<a href="#" class="dropdown-item">
																	<i class="ph-eye me-2"></i>
																	View Area
																</a>
																<a href="#" class="dropdown-item">
																	<i class="ph-download me-2"></i>
																	Download Requirements
																</a>
															</div>
														</div>
													</div>
												</td>
											</tr>							
									
										</tbody>
									</table>
								</div>
								<!-- /hover rows -->

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