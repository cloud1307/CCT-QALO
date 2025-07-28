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
$schProgram = $model->getAllSchoolProgram();
//print_r($schProgram);
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
								<span class="breadcrumb-item active">List of School Programs</span>
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
												<h5 class="mb-0">List of School Programs</h5>												
												<?php	include '../modal/modal.php'; ?>
												<a href="#modal_school_program" class="btn btn-outline-success" data-bs-toggle="modal"><i class="ph-buildings me-2"></i> Add School Program</a> 
										</div>								
									</div>

									<table class="table datatable-basic table-hover">
										<thead>
											<tr>
												<th>School</th>
												<th>Program Description</th>
												<th>Program Code</th>												
												<th>Status</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($schProgram as $row): ?>											
											<tr>
												<td><?= htmlspecialchars($row['varSchoolName']) ?></td>
												<td><?= htmlspecialchars($row['varProgramName']) ?></td>
												<td><?= htmlspecialchars($row['varProgramCode']) ?></td>												
												<td><span class="badge bg-success bg-opacity-10 text-success"><?= htmlspecialchars($row['enumProgramStatus']) ?></span></td>
												<td class="text-center">
													<div class="d-inline-flex">
														<div class="dropdown">
															<a href="#" class="text-body" data-bs-toggle="dropdown">
																<i class="ph-list"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-end">
																<a href="javascript:void(0);" 
																		class="dropdown-item"
																		onclick="openUpdateSchoolProgramModal(<?= $row['intProgramID'] ?>, 
																		'<?= htmlspecialchars($row['intSchoolID'], ENT_QUOTES) ?>',																		
																		'<?= htmlspecialchars($row['varProgramName'], ENT_QUOTES) ?>',
																		'<?= htmlspecialchars($row['varProgramCode'], ENT_QUOTES) ?>')">																	
																			<i class="ph-pencil me-2"></i>
																			Edit
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