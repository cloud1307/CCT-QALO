<?php 
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
include '../include/header.php'; ?>
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
								<span class="breadcrumb-item active">Add Employee</span>
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
							<div class="card">	
								<div class="card-header">
										<div class="card-title modal-footer justify-content-between">
												<h5 class="mb-0">Employee Information</h5>
										</div>
								<form class="needs-validation" action="#" novalidate method="POST">
										
									<div class="row">
											<div class="form-label col-lg-12">												
												<label class="form-label">Employee Number</label>
													<div class="form-control-feedback">
														<input type="number" name="EmployeeNumber" class="form-control" required>
														<div class="invalid-feedback">Enter Employee Number</div>															
													</div>				                                
											</div>
											<div class="form-label col-lg-12">												
												<label class="form-label">Last Name</label>
													<div class="form-control-feedback">
														<input type="text" name="lastName" class="form-control" required>
														<div class="invalid-feedback">Enter LastName</div>															
													</div>				                                
											</div>
											<div class="form-label col-lg-12">												
												<label class="form-label">First Name</label>
													<div class="form-control-feedback">
														<input type="text" name="firstName" class="form-control" required>
														<div class="invalid-feedback">Enter FirstName</div>															
													</div>				                                
											</div>
											<div class="form-label col-lg-4">												
												<label class="form-label">Middle Name</label>
													<div class="form-control-feedback">
														<input type="text" name="middleName" class="form-control" required>
														<div class="invalid-feedback">Enter MiddleName</div>															
													</div>				                                
											</div>
											<div class="form-label col-lg-4">												
												<label class="form-label">Extension Name (eg. Jr., Sr.)</label>
													<div class="form-control-feedback">
														<input type="text" name="firstname" class="form-control" required>
														<div class="invalid-feedback">Enter Extension Name</div>															
													</div>				                                
											</div>
											<div class="form-label col-lg-4">												
												<label class="form-label">Gender</label>
													<div class="form-control-feedback">
														<select class="form-select">
															<option value="">Select Gender</option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
														</select>
														<div class="invalid-feedback">Select Gender</div>															
													</div>																													                                
											</div>
											<div class="form-label col-lg-6">												
												<label class="form-label">Civil Status</label>
													<select class="form-select">
														<option value="">Select Civil Status</option>
														<option value="Single">Single</option>
														<option value="Married">Married</option>
														<option value="Widowed">Widowed</option>
														<option value="Divorce">Divorce</option>
														<option value="Separated">Separated</option>
														<option value="Annulled">Annulled</option>  
													</select>																                                
											</div>
											<div class="form-label col-lg-6">												
												<label class="form-label">Date of Birth</label>
													<div class="form-control-feedback form-control-feedback-start">
															<input type="text" name="dateOfBirth" class="form-control datepicker-date-format" placeholder="Enter date in yyyy-mm-dd format"  required>										
														<div class="invalid-feedback">Enter Date of Birth</div>
														<div class="form-control-feedback-icon">
															<i class="ph-calendar text-muted"></i>
														</div>
													</div>
											</div>
											<div class="form-label col-lg-6">												
												<label class="form-label">Date of Birth</label>
											
											</div>										


										</div>

										<div class="form-label modal-footer">
											<a href="#" class="btn btn-link">Close</a>
											<button type="submit" class="btn btn-primary">Add Emplyoee</button>
										</div>
								</form>

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