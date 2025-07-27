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
$positions = $model->getAllPosition();

$school = $model->getAllSchool();
$provinces = $model->getAllProvince();
//print_r($school);
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
														<input type="number" name="EmployeeNumber" class="form-control" placeholder="Enter Employee Number" required>
														<div class="invalid-feedback">Enter Employee Number</div>															
													</div>				                                
											</div>
											<div class="form-label col-lg-12">												
												<label class="form-label">Last Name</label>
													<div class="form-control-feedback">
														<input type="text" name="lastName" class="form-control text-uppercase" placeholder="Enter LastName" required>
														<div class="invalid-feedback">Enter LastName</div>															
													</div>				                                
											</div>
											<div class="form-label col-lg-12">												
												<label class="form-label">First Name</label>
													<div class="form-control-feedback">
														<input type="text" name="firstName" class="form-control text-uppercase" placeholder="Enter FirstName" required>
														<div class="invalid-feedback">Enter FirstName</div>															
													</div>				                                
											</div>
											<div class="form-label col-lg-4">												
												<label class="form-label">Middle Name or N/A</label>
													<div class="form-control-feedback">
														<input type="text" name="middleName" class="form-control text-uppercase" placeholder="Enter MiddleName or N/A" required>
														<div class="invalid-feedback">Enter MiddleName</div>															
													</div>				                                
											</div>
											<div class="form-label col-lg-4">												
												<label class="form-label">Extension Name (eg. Jr., Sr.) or  N/A</label>
													<div class="form-control-feedback">
														<input type="text" name="extension" class="form-control text-uppercase" placeholder="Enter Extension (eg. Jr., Sr.) or N/A " required>
														<div class="invalid-feedback">Enter Extension Name</div>															
													</div>				                                
											</div>
											<div class="form-label col-lg-4">												
												<label class="form-label">Gender</label>
													<div class="form-control-feedback">
														<select class="form-select" required>
															<option value="">Select Gender</option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
														</select>
														<div class="invalid-feedback">Select Gender</div>															
													</div>																													                                
											</div>
											<div class="form-label col-lg-6">												
												<label class="form-label">Civil Status</label>
													<div class="form-control-feedback form-control-feedback-start">
														<select class="form-select" required>
															<option value="">Select Civil Status</option>
															<option value="Single">Single</option>
															<option value="Married">Married</option>
															<option value="Widowed">Widowed</option>
															<option value="Divorce">Divorce</option>
															<option value="Separated">Separated</option>
															<option value="Annulled">Annulled</option>  
														</select>
														<div class="invalid-feedback">Select Civil Status</div>
													</div>															                                
											</div>
											<div class="form-label col-lg-6">												
												<label class="form-label">Date of Birth</label>
													<div class="form-control-feedback form-control-feedback-start">
															<input type="text" name="dateOfBirth" class="form-control datepicker-date-format" placeholder="Enter date in yyyy-mm-dd"  required>										
														<div class="invalid-feedback">Enter Date of Birth</div>
														<div class="form-control-feedback-icon">
															<i class="ph-calendar text-muted"></i>
														</div>
													</div>
											</div>

											<div class="form-label col-lg-6">												
												<label class="form-label">House No.</label>
													<div class="form-control-feedback">
														<input type="text" name="houseNo" class="form-control text-uppercase" placeholder="Enter House Number" required>
														<div class="invalid-feedback">Enter House Number</div>															
													</div>				                                
											</div>

											<div class="form-label col-lg-6">												
												<label class="form-label">Street/Building/Floor</label>
													<div class="form-control-feedback">
														<input type="text" name="street" class="form-control text-uppercase" placeholder="Enter Street/Building/Floor" required>
														<div class="invalid-feedback">Enter Street/Building/Floor</div>															
													</div>				                                
											</div>											

											<div class="form-label col-lg-4">												
												<label class="form-label">Province</label>
													<div class="form-control-feedback ">
														<select class="form-control" name="province" id="province" required>
															<option value="">Select Province</option>
															<?php if (!empty($provinces)): ?>
																<?php foreach ($provinces as $prov): ?>
																	<option value="<?= htmlspecialchars($prov['provid']) ?>"><?= htmlspecialchars($prov['prov']) ?></option>
																<?php endforeach; ?>
															<?php else: ?>
																<option value="">No Province Available</option>
															<?php endif; ?>
														</select>
														<div class="invalid-feedback">Select Province</div>
													</div>															                                
											</div>
											
											<div class="form-label col-lg-4">												
												<label class="form-label">City/Municipality</label>
													<div class="form-control-feedback ">
														<select class="form-control" name="citymun" id="cityMun" required>
															<option value="">Select City/Municipality</option>
														</select>
														<div class="invalid-feedback">Select City/Municipality</div>
													</div>															                                
											</div>

											<div class="form-label col-lg-4">												
												<label class="form-label">Barangay</label>
													<div class="form-control-feedback ">
														<select class="form-control" name="barangay" id="barangay" required>
															<option value="">Select Barangay</option>
														</select>
														<div class="invalid-feedback">Select Barangay</div>
													</div>															                                
											</div>

											<div class="form-label col-lg-4">												
												<label class="form-label">School or Department</label>
													<div class="form-control-feedback form-control-feedback-start">
														<select class="form-select" name="school" required>
															<option value="">Select School</option>
															<?php if (!empty($school)): ?>
																<?php foreach ($school as $row): ?>
																	<option value="<?= htmlspecialchars($row['intSchoolID']) ?>"><?= htmlspecialchars($row['varSchoolCode']) ?></option>
																<?php endforeach; ?>
															<?php else: ?>
																<option value="">No School Available</option>
															<?php endif; ?>
														</select>
														<div class="invalid-feedback">Select School</div>
													</div>															                                
											</div>

											<div class="form-label col-lg-4">												
												<label class="form-label">Designation</label>
												<div class="form-control-feedback form-control-feedback-start">
													<select class="form-select" name="position" required>
														<option value="">Select Designation</option>
														<?php if (!empty($positions)): ?>
															<?php foreach ($positions as $position): ?>
																<option value="<?= htmlspecialchars($position['intPositionID']) ?>"><?= htmlspecialchars($position['varPosition']) ?></option>
															<?php endforeach; ?>
														<?php else: ?>
															<option value="">No Designation Available</option>
														<?php endif; ?>
													</select>
													<div class="invalid-feedback">Select Designation</div>
												</div>						
											</div>

											<div class="form-label col-lg-4">												
												<label class="form-label">Employment Date</label>
													<div class="form-control-feedback form-control-feedback-start">
															<input type="text" name="employmentDate" class="form-control datepicker-date-format1" placeholder="Enter date in yyyy-mm-dd"  required>										
														<div class="invalid-feedback">Enter Date of Employment</div>
														<div class="form-control-feedback-icon">
															<i class="ph-calendar text-muted"></i>
														</div>
													</div>
											</div>

											<div class="form-label col-lg-4">												
												<label class="form-label">Job status</label>
													<div class="form-control-feedback form-control-feedback-start">
														<select class="form-select" name="jobStatus" required>
															<option value="">Select Job Status</option>
															<option value="Contract of Service">Contract of Service</option>	
															<option value="Permanent">Permanent</option>
															<option value="Job Order">Job Order</option>													
															<option value="Contractual">Contractual</option>
															<option value="Co-Terminus">Co-Terminus</option>
														</select>
														<div class="invalid-feedback">Select Job Status</div>
													</div>												                                
											</div>

											<div class="form-label col-lg-4">												
												<label class="form-label">Job Catergory</label>
													<div class="form-control-feedback form-control-feedback-start">
														<select class="form-select" name="jobCategory" required>
															<option value="">Select Job Category</option>
															<option value="Non-Teaching Personnel">Non-Teaching Personnel</option>
															<option value="Administrative Staff">Administrative Staff</option>	
															<option value="Fulltime Instructor">Fulltime Instructor</option>	
															<option value="Part-Time Instructor">Part-Time Instructor</option>															
														</select>
														<div class="invalid-feedback">Select Job Category</div>
													</div>												                                
											</div>

											<div class="form-label col-lg-4">												
												<label class="form-label">User Level</label>
													<div class="form-control-feedback form-control-feedback-start">
														<select class="form-select" name="userlevel" required>
															<option value="">Select User Level</option>
															<option value="System Administrator">System Administrator</option>																												
															<option value="Faculty">Faculty</option>
															<option value="Administrative Staff">Administrative Staff</option>
															<option value="HR Head">HR Head</option>
														</select>
														<div class="invalid-feedback">Select User Level</div>
													</div>																                                
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
