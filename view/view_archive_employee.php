<?php 
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

include '../include/header.php';

// Load controller
require_once '../config/config.php'; // where $conn is defined
require_once '../controller/employeeController.php';


$db = new Database();
$conn = $db->connect();
$model = new EmployeeModel($conn);
$employee = $model->getAllEmployee('non-active');
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
								<span class="breadcrumb-item active">List of Inactive Employee</span>
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
												<h5 class="mb-0">List of Inactive Employee</h5>
												<a href="view_employee.php" class="btn btn-outline-primary" ><i class="ph-person me-2"></i> View Employee</a> 
										</div>								
									</div>

									<table class="table datatable-basic table-hover">
										<thead>
											<tr>
												<th style="width: 20%;">LastName</th>
												<th style="width: 20%;">FirstName</th>
												<th style="width: 30%;">Position</th>
												<th style="width: 15%;">Department</th>
												<th style="width: 15%;">Job Category</th>													
												<th>Status</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($employee as $row): 
												$status = $row['enumEmploymentStatus'];
													$badgeClass = 'bg-secondary'; // default
													switch ($status) {
														case 'Active':
															$badgeClass = 'bg-success bg-opacity-10 text-success';
															break;
														case 'Inactive':
															$badgeClass = 'bg-info bg-opacity-10 text-info';
															break;
														case 'Resigned':
															$badgeClass = 'bg-warning bg-opacity-10 text-warning';
															break;
														case 'Terminated':
														case 'Non-Renewal':
															$badgeClass = 'bg-danger bg-opacity-10 text-danger';
															break;
													}												
												?>
											<tr>
												<td><?= htmlspecialchars($row['varLastName']) ?></td>
												<td><?= htmlspecialchars($row['varFirstName']) ?></td>
												<td><?= htmlspecialchars($row['varPosition']) ?></td>
												<td><?= htmlspecialchars($row['varSchoolCode']) ?></td>
												<td><?= htmlspecialchars($row['enumJobCategory']) ?></td>
												<!-- <td>BSE</td>												 -->
												<td><a href="#"><span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($status) ?></span></a></td>
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
																	<i class="ph-user me-2"></i>
																	View Profile
																</a>
																<a href="#" class="dropdown-item">
																	<i class="ph-file me-2"></i>
																	Service Record
																</a>
															</div>
														</div>
													</div>
												</td>
											</tr>
											<?php endforeach; ?>						
									
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