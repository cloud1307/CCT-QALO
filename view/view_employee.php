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
$employee = $model->getAllEmployee('Active');
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
								<span class="breadcrumb-item active">List of Employee</span>
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
												<h5 class="mb-0">List of Employee</h5>												
												<?php	include '../modal/modal.php'; ?>
												<a href="employee.php" class="btn btn-outline-success" ><i class="ph-users me-2"></i> Add Employee</a> 
										</div>								
									</div>

									<table class="table datatable-basic dataTable no-footer table-hover" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
										<thead>
											<tr>
												<th >LastName</th>
												<th >FirstName</th>
												<th >Position</th>
												<th >Department</th>
												<th >Job Category</th>													
												<th >Status</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $number = 1; foreach ($employee as $row): ?>
											<tr>
												<td><?= htmlspecialchars($row['varLastName']) ?></td>
												<td><?= htmlspecialchars($row['varFirstName']) ?></td>
												<td><?= htmlspecialchars($row['varPosition']) ?></td>
												<td><?= htmlspecialchars($row['varSchoolName']) ?></td>
												<td><?= htmlspecialchars($row['enumJobCategory']) ?></td>
												<td><a href="javascript:void(0);" onclick="updateStatusModal('<?= htmlspecialchars($row['enumEmploymentStatus'], ENT_QUOTES) ?>', <?= (int)$row['intEmployeeID'] ?>)"><span class="badge bg-success bg-opacity-10 text-success"><?= htmlspecialchars($row['enumEmploymentStatus']) ?></span></a></td>
												
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
																	View Profile
																</a>
																<a href="#" class="dropdown-item">
																	<i class="ph-download me-2"></i>
																	Download Files
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (isset($_GET['status']) && isset($_GET['message'])): ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let status = "<?= htmlspecialchars($_GET['status']) ?>";
    let message = "<?= htmlspecialchars($_GET['message']) ?>";

    Swal.fire({
        title: status === 'success' ? 'Success!' : 'Error!',
        text: message,
        icon: status,
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'view_employee.php'; // Clear URL
    });
});
</script>
<?php endif; ?>