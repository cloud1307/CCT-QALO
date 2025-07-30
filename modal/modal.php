<?php 
require_once '../config/config.php'; // where $conn is defined
require_once '../controller/employeeController.php';


$db = new Database();
$conn = $db->connect();

$model = new EmployeeModel($conn);
$schools = $model->getAllSchool('Academic');
$schProgram = $model->getAllSchoolProgram();
//$majorProgram = $model->getAllMajorProgram();
?>
<!-- Update Account Modal -->
	<div id="modal-account" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-white border-0">					
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<div class="text-center mb-3">
								<div class="d-inline-flex bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-1 mb-3 mt-1">
									<img src="../assets/images/logo_qalo.png" class="h-80px" alt="">
								</div>
									<h5 class="mb-0">User Account</h5>
									<span class="d-block text-muted">Hello!, <?= htmlspecialchars(isset($userData['enumUserLevel']) ? $userData['enumUserLevel'] : 'Not available') ?>	</span>
								</div>						
						<form class="needs-validation" action="#" novalidate method="POST">
							<div class="modal-body">	
									<div class="mb-3">
										<label class="form-label">Your Email Address</label>
										<div class="form-control-feedback form-control-feedback-start">
											<input type="email" class="form-control" placeholder="john@doe.com" disabled name="recovery_email" value="<?= htmlspecialchars(isset($userData['varEmail']) ? $userData['varEmail'] : 'Not available') ?>">
											<div class="form-control-feedback-icon">
												<i class="ph-envelope text-muted"></i>
											</div>
										</div>
									</div>

									<div class="mb-3">
										<label class="form-label">Recovery Email Address</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text"  class="form-control" placeholder="john@doe.com" name="recovery_email" value="<?= htmlspecialchars($userData['varRecoveryEmail'] ?? 'Not available') ?>" required>										
										<div class="invalid-feedback">Enter Recovery Email</div>
											<div class="form-control-feedback-icon">
												<i class="ph-envelope text-muted"></i>
											</div>
										</div>										
									</div>								

									<div class="mb-3">
										<label class="form-label">Contact Number</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text"  class="form-control" placeholder="999-9999-999" maxlength="10" data-mask="+99-99-9999-9999" name="contactNumber" value="<?= htmlspecialchars($userData['varContactNumber'] ?? 'Not available') ?>" required>										
										<div class="invalid-feedback">Enter Contact Number</div>
											<div class="form-control-feedback-icon">
												<i class="ph-phone text-muted"></i>	
											</div>
										</div>										
									</div>																
							</div>
							<div class="modal-footer">
									<button type="submit" class="btn btn-primary w-100">
										<i class="ph-pencil me-2"></i>
										Update Account
									</button>
							</div>
						</form>
			</div>
		</div>
	</div>
<!-- /Update Account Modal -->

<!-- User Account Modal -->
	<div id="modal_account" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-success text-white border-0">
					<h5 class="modal-title"><i class="ph-plus me-2"></i>Add Account</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" action="#" novalidate method="POST">
							<div class="modal-body">				
									
									<div class="mb-3">
										<label class="form-label">Email Address</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text" name="schoolEmail" class="form-control" required>
											<span class="input-group-text">@citycollegeoftagaytay.edu.ph</span>
											<div class="invalid-feedback">Enter School Email</div>
											<div class="form-control-feedback-icon">
												<i class="ph-envelope text-muted"></i>
											</div>
										</div>
									</div>	

									<div class="mb-3">
										<label class="form-label">Recovery Email Address</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text"  class="form-control" placeholder="john@doe.com" name="recovery_email" value="<?= htmlspecialchars($userData['varRecoveryEmail'] ?? 'Not available') ?>" required>										
										<div class="invalid-feedback">Enter Recovery Email</div>
											<div class="form-control-feedback-icon">
												<i class="ph-envelope text-muted"></i>
											</div>
										</div>										
									</div>	

									<div class="mb-3">
										<label class="form-label">School Program</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text" name="accreditation" class="form-control text-uppercase"  required>										
										<div class="invalid-feedback">Enter School Program</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-house-line text-muted"></i>
											</div> -->
										</div>
									</div>
									
									<div class="mb-3">
										<label class="form-label">Major Course</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text"  class="form-control text-uppercase" name="codeName" required>										
										<div class="invalid-feedback">Enter Major Course</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-bookmark text-muted"></i>
											</div> -->
										</div>
									</div>							
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-success">Add Account</button>
							</div>
						</form>
			</div>
		</div>
	</div>
<!-- /User Account Modal -->

<!-- Position Modal -->
	<div id="modal_position" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-success text-white border-0" id="modal-header">
					<h5 class="modal-title" id="modal-title"><i class="ph-plus me-2"></i>Add Position</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" id="positionForm" action="../controller/employeeController.php" novalidate method="POST">
							<div class="modal-body">
								<input type="hidden" name="position_id" id="position_id">
									<div class="mb-3">
										<label class="form-label">Position</label>
										<div class="form-control-feedback input-group">
											<input type="text" name="position" class="form-control text-propercase " placeholder ="Enter Position" required>
										</div>
									</div>
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-success" id="btn-save">Add Position</button>
							</div>
						</form>
			</div>
		</div>
	</div>
<!-- /Position Modal -->

<!-- Accreditation Modal -->
	<div id="modal_accreditation" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-success text-white border-0">
					<h5 class="modal-title"><i class="ph-plus me-2"></i>Add Accreditation</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" id="accreditationForm" action="#" novalidate method="POST">
							<div class="modal-body">				
									<div class="mb-3">
										<label class="form-label">Accreditation Name</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text" name="accreditation" class="form-control text-uppercase "  required>										
										<div class="invalid-feedback">Enter Accreditation Name</div>
											<div class="form-control-feedback-icon">
												<i class="ph-buildings text-muted"></i>
											</div>
										</div>
									</div>

									
									<div class="mb-3">
										<label class="form-label">Accreditation Code Name</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text"  class="form-control text-uppercase" name="codeName" required>										
										<div class="invalid-feedback">Enter Code Name</div>
											<div class="form-control-feedback-icon">
												<i class="ph-bookmarks-simple text-muted"></i>
											</div>
										</div>
									</div>							
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-success">Save changes</button>
							</div>
						</form>
			</div>
		</div>
	</div>
<!-- /Accreditation Modal -->


<!-- Area Modal -->
	<div id="modal_area" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-success text-white border-0">
					<h5 class="modal-title"><i class="ph-plus me-2"></i>Add Area</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" action="#" novalidate method="POST">
							<div class="modal-body">				
									<div class="mb-3">
										<label class="form-label">Area Name</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text" name="area" class="form-control text-uppercase"  required>										
										<div class="invalid-feedback">Enter Area Name</div>
											<div class="form-control-feedback-icon">
												<i class="ph-buildings text-muted"></i>
											</div>
										</div>
									</div>				
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-success">Save changes</button>
							</div>
						</form>
			</div>
		</div>
	</div>
<!-- /Area Modal -->

<!-- Summary Requirements Modal -->
	<div id="modal_summaryreq" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-success text-white border-0">
					<h5 class="modal-title"><i class="ph-plus me-2"></i>Add Summary Requirements</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" action="#" novalidate method="POST">
							<div class="modal-body">				
									<div class="mb-3">
										<label class="form-label">Area Name</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text" name="accreditation" class="form-control text-uppercase"  required>										
										<div class="invalid-feedback">Enter Area</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-briefcase text-muted"></i>
											</div> -->
										</div>
									</div>
									
									<div class="mb-3">
										<label class="form-label">Requirements</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text"  class="form-control text-uppercase" name="codeName" required>										
										<div class="invalid-feedback">Enter Requirements</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-handshake text-muted"></i>
											</div> -->
										</div>
									</div>							
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-success">Save changes</button>
							</div>
						</form>
			</div>
		</div>
	</div>
<!-- /Summary Requirements Modal -->

<!-- School Modal -->
	<div id="modal_school" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-success text-white border-0" id="modal-header-school">
					<h5 class="modal-title" id="modal-title-school"><i class="ph-plus me-2"></i>Add Schools</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" id="schoolForm" action="../controller/employeeController.php" novalidate method="POST">
							<div class="modal-body">				
									<input type="hidden" name="school_id" id="school_id">
									<div class="mb-3">
										<label class="form-label">School Name</label>
										<div class="form-control-feedback  input-group">
											<input type="text" name="schoolName" class="form-control text-uppercase" placeholder="Enter School Name"  required>										
										<!-- <div class="invalid-feedback">Enter School</div>											 -->
										</div>
									</div>
									
									<div class="mb-3">
										<label class="form-label">School Code</label>
										<div class="form-control-feedback  input-group">
											<input type="text"  class="form-control text-uppercase" name="schoolCodeName" placeholder="Enter School Code" required>										
										<!-- <div class="invalid-feedback">Enter School Code</div>											 -->
										</div>
									</div>
									<div class="mb-3">												
										<label class="form-label">Department Catergory</label>
											<div class="form-control-feedback">												
												<select class="form-select" name="deptCategory" id="deptCategory" required>
													<option value="">Select Department Category</option>
													<option value="Academic">Academic</option>
													<option value="Non-Academic">Non-Academic</option>																										
												</select>													
											</div>												                                
									</div>							
									
									
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-success" id="btn-save-school">Add School</button>
							</div>
						</form>
			</div>
		</div>
	</div>
<!-- /School Modal -->

<!-- School Program Modal -->
	<div id="modal_school_program" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-success text-white border-0" id="modal-header-school-program">
					<h5 class="modal-title" id="modal-title-school-program"><i class="ph-plus me-2"></i>Add School Program</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" id="schoolProgramForm" action="../controller/employeeController.php" novalidate method="POST">
							<div class="modal-body">
								<input type="hidden" name="school_program_id" id="school_program_id">
									<div class="mb-3">												
											<label class="form-label">School</label>
												<div class="form-control-feedback">
													<select class="form-select" name="schoolProgram" id="schoolProgram" required>
														<option value="">Select School</option>
														<?php 														
														if (!empty($schools)): ?>
															<?php foreach ($schools as $row): ?>
																<option value="<?= htmlspecialchars($row['intSchoolID']) ?>"><?= htmlspecialchars($row['varSchoolName']) ?></option>
															<?php endforeach; ?>
														<?php else: ?>
															<option value="">No School Available</option>
															<?php endif; ?>
													</select>
														<div class="invalid-feedback">Select School</div>
												</div>															                                
									</div>				
									<div class="mb-3">
										<label class="form-label">Program Description</label>
										<div class="form-control-feedback input-group">
											<input type="text" name="programDescription" class="form-control text-uppercase"  required>										
										<div class="invalid-feedback">Enter Program Description</div>											
										</div>
									</div>
									
									<div class="mb-3">
										<label class="form-label">Program Code</label>
										<div class="form-control-feedback  input-group">
											<input type="text"  class="form-control text-uppercase" name="programCode" required>										
										<div class="invalid-feedback">Enter Program Code</div>											
										</div>
									</div>							
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-success" id="btn-save-school-program">Add School Program</button>
							</div>
						</form>
			</div>
		</div>
	</div>
<!-- /School Program Modal -->


<!-- Major Course Modal -->
	<div id="modal_major_course" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-success text-white border-0" id="modal-header-major-program">
					<h5 class="modal-title" id="modal-title-major-program"><i class="ph-plus me-2"></i>Add Major Course</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" id="majorProgramForm"  action="../controller/employeeController.php" novalidate method="POST">
							<div class="modal-body">
								<input type="hidden" name="major_program_id" id="major_program_id">
									<div class="mb-3">												
											<label class="form-label">School Program</label>
												<div class="form-control-feedback input-group">
													<select class="form-select" name="ProgramDescription" id="ProgramDescription" required>
														<option value="">Select School Program</option>
														<?php 
														
														if (!empty($schProgram)): ?>
															<?php foreach ($schProgram as $row): ?>
																<option value="<?= htmlspecialchars($row['intProgramID']) ?>"><?= htmlspecialchars($row['varProgramName']) ?></option>
															<?php endforeach; ?>
														<?php else: ?>
															<option value="">No School Program Available</option>
															<?php endif; ?>
													</select>														
												</div>														                                
									</div>									
									<div class="mb-3">
										<label class="form-label">Major Course</label>
										<div class="form-control-feedback  input-group">
											<input type="text"  class="form-control text-uppercase" name="majorProgram" required>										
										<div class="invalid-feedback">Enter Major Course</div>											
										</div>
									</div>							
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-success" id="btn-save-major-program">Add Major Program</button>
							</div>
						</form>
			</div>
		</div>
	</div>
<!-- /Major Course Modal -->

<!-- Board Resolution Modal -->
	<div id="modal_board_resolution" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-success text-white border-0" id="modal-header-board-resolution">
					<h5 class="modal-title" id="modal-title-board-resolution"><i class="ph-plus me-2"></i>Add Board Resolution</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" id="boardResolutionForm"  action="../controller/employeeController.php" novalidate method="POST" enctype="multipart/form-data"> 
							<div class="modal-body">
									<input type="hidden" name="board_resolution_id" id="board_resolution_id">
									<input type="hidden" name="deleteResolution" value="delete">									
									<div class="mb-3">
										<label class="form-label">Board Resolution Title</label>
										<div class="form-control-feedback input-group">
											<textarea rows="3" cols="3" class="form-control text-uppercase" name="boardResolution" placeholder="Board Resolution Title" required></textarea>
											<div class="invalid-feedback">Enter Board Resolution</div>		
										</div>
									</div>									
									<div class="mb-3">
										<label class="form-label">Resolution Code</label>
										<div class="form-control-feedback input-group">
											<input type="text"  class="form-control text-uppercase" name="resolutionCode" required>										
										<div class="invalid-feedback">Enter Resolution Code</div>											
										</div>
									</div>
									<div class="mb-3">
										<label class="form-label">Resolution Year</label>
										<div class="form-control-feedback input-group">
											<input type="number"  class="form-control text-uppercase" maxlength="4" name="resolutionYear" required>										
										<div class="invalid-feedback">Enter Resolution Year</div>											
										</div>
									</div>

									<div class="mb-3">
										<label class="form-label">Resolution File</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="file"  class="form-control text-uppercase" name="fileBoardResolution" accept=".pdf">										
											<span class="input-group-text">.pdf</span>	
											<div class="invalid-feedback">Upload File Resolution</div>
											<div class="form-control-feedback-icon">
												<i class="ph-file-arrow-up  text-muted"></i>
											</div>
										</div>
									</div>													
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-success" id="btn-save-board-resolution">Add Board Resolution</button>
								</div>
						</form>
			</div>
		</div>
	</div>
<!-- /Board Resolution Modal -->


<!-- Academic Resolution Modal -->
	<div id="modal_academic_resolution" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-success text-white border-0" id="modal-header-academic-resolution">
					<h5 class="modal-title" id="modal-title-academic-resolution"><i class="ph-plus me-2"></i>Add Academic Resolution</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" id="academicResolutionForm" action="../controller/employeeController.php" novalidate method="POST">
							<div class="modal-body">
								<input type="hidden" name="academic_resolution_id" id="academic_resolution_id">									
									<div class="mb-3">
										<label class="form-label">Academic Resolution Title</label>
										<div class="form-control-feedback input-group">
											<textarea rows="3" cols="3" class="form-control text-uppercase" name="academicResolution" placeholder="Academic Resolution Title" required></textarea>
											<div class="invalid-feedback">Enter Board Resolution</div>		
										</div>
									</div>
									
									<div class="mb-3">
										<label class="form-label">Resolution Code</label>
										<div class="form-control-feedback  input-group">
											<input type="text"  class="form-control text-uppercase" name="academicresolutionCode" required>										
										<div class="invalid-feedback">Enter Resolution Code</div>											
										</div>
									</div>
									<div class="mb-3">
										<label class="form-label">Resolution Year</label>
										<div class="form-control-feedback  input-group">
											<input type="number"  class="form-control text-uppercase" maxlength="4" name="academicResolutionYear" required>										
										<div class="invalid-feedback">Enter Resolution Year</div>											
										</div>
									</div>

									<div class="mb-3">
										<label class="form-label">Academic Resolution File</label>
										<div class="form-control-feedback input-group">
											<input type="file"  class="form-control text-uppercase" name="AcadfileResolution" id="academicFileResolution" accept=".pdf" >										
											<span class="input-group-text">.pdf</span>	
										<div class="invalid-feedback">Please upload a valid PDF file.</div>
											<div class="form-control-feedback-icon">
												<i class="ph-file-arrow-up  text-muted"></i>
											</div>
										</div>
									</div>													
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-success" id="btn-save-academic-resolution">Add Academic Resolution</button>
							</div>
						</form>
			</div>
		</div>
	</div>
<!-- /Academic Resolution Modal -->






<script>
document.getElementById('uploadForm').addEventListener('submit', function (e) {
	e.preventDefault(); // Prevent form from submitting by default

	const fileInput = document.getElementById('fileResolution');
	const file = fileInput.files[0];

	// Check if a file is selected and is a PDF
	if (!file || file.type !== "application/pdf") {
		fileInput.classList.add('is-invalid');
	} else {
		fileInput.classList.remove('is-invalid');
		// You can now submit the form manually if all validation passes
		// this.submit(); // Uncomment to allow submission
		alert('File is valid and ready to be uploaded!');
	}
});
</script>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteBoardResolutionModal" tabindex="-1" aria-labelledby="deleteBoardResolutionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="deleteBoardResolutionForm">
      <input type="hidden" name="boardResolutionID" id="deleteBoardResolutionID">
      <input type="hidden" name="delete" value="true">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteBoardResolutionLabel"><i class="ph-trash me-2"></i>Delete Board Resolution</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this Board Resolution?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Confirm Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>