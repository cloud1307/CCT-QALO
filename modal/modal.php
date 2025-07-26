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
								<button type="submit" class="btn btn-primary">Add Account</button>
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
								<!-- <button type="submit" class="btn btn-primary">Add Position</button> -->
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
						<form class="needs-validation" action="#" novalidate method="POST">
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
								<button type="submit" class="btn btn-primary">Save changes</button>
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
								<button type="submit" class="btn btn-primary">Save changes</button>
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
								<button type="submit" class="btn btn-primary">Save changes</button>
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
				<div class="modal-header bg-success text-white border-0">
					<h5 class="modal-title"><i class="ph-plus me-2"></i>Add Schools</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" action="#" novalidate method="POST">
							<div class="modal-body">				
									<div class="mb-3">
										<label class="form-label">School Name</label>
										<div class="form-control-feedback  input-group">
											<input type="text" name="schoolName" class="form-control text-uppercase"  required>										
										<div class="invalid-feedback">Enter School</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-house-line text-muted"></i>
											</div> -->
										</div>
									</div>
									
									<div class="mb-3">
										<label class="form-label">School Code</label>
										<div class="form-control-feedback  input-group">
											<input type="text"  class="form-control text-uppercase" name="schoolCodeName" required>										
										<div class="invalid-feedback">Enter School Code</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-bookmark text-muted"></i>
											</div> -->
										</div>
									</div>							
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Add School</button>
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
				<div class="modal-header bg-success text-white border-0">
					<h5 class="modal-title"><i class="ph-plus me-2"></i>Add School Program</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" action="#" novalidate method="POST">
							<div class="modal-body">				
									<div class="mb-3">
										<label class="form-label">Program Description</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text" name="accreditation" class="form-control text-uppercase"  required>										
										<div class="invalid-feedback">Enter Program Description</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-house-line text-muted"></i>
											</div> -->
										</div>
									</div>
									
									<div class="mb-3">
										<label class="form-label">Program Code</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text"  class="form-control text-uppercase" name="codeName" required>										
										<div class="invalid-feedback">Enter Program Code</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-bookmark text-muted"></i>
											</div> -->
										</div>
									</div>							
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Add School</button>
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
				<div class="modal-header bg-success text-white border-0">
					<h5 class="modal-title"><i class="ph-plus me-2"></i>Add Major Course</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" action="#" novalidate method="POST">
							<div class="modal-body">				
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
								<button type="submit" class="btn btn-primary">Add School</button>
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
				<div class="modal-header bg-success text-white border-0">
					<h5 class="modal-title"><i class="ph-plus me-2"></i>Add Board Resolution</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" action="#" novalidate method="POST">
							<div class="modal-body">				
									<div class="mb-3">
										<label class="form-label">Board Resolution Title</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text" name="boardResolution" class="form-control text-uppercase"  required>										
										<div class="invalid-feedback">Enter Board Resolution</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-house-line text-muted"></i>
											</div> -->
										</div>
									</div>
									
									<div class="mb-3">
										<label class="form-label">Resolution Code</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text"  class="form-control text-uppercase" name="resolutionCode" required>										
										<div class="invalid-feedback">Enter Resolution Code</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-bookmark text-muted"></i>
											</div> -->
										</div>
									</div>
									<div class="mb-3">
										<label class="form-label">Resolution Year</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="number"  class="form-control text-uppercase" maxlength="4" name="resolutionYear" required>										
										<div class="invalid-feedback">Enter Resolution Year</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-bookmark text-muted"></i>
											</div> -->
										</div>
									</div>

									<div class="mb-3">
										<label class="form-label">Resolution File</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="file"  class="form-control text-uppercase"  name="fileResolution" accept=".pdf" required>										
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
								<button type="submit" class="btn btn-primary">Add School</button>
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
				<div class="modal-header bg-success text-white border-0">
					<h5 class="modal-title"><i class="ph-plus me-2"></i>Add Academic Resolution</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
						<form class="needs-validation" action="#" novalidate method="POST">
							<div class="modal-body">				
									<div class="mb-3">
										<label class="form-label">Academic Resolution Title</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text" name="boardResolution" class="form-control text-uppercase"  required>										
										<div class="invalid-feedback">Enter Board Resolution</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-house-line text-muted"></i>
											</div> -->
										</div>
									</div>
									
									<div class="mb-3">
										<label class="form-label">Resolution Code</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text"  class="form-control text-uppercase" name="resolutionCode" required>										
										<div class="invalid-feedback">Enter Resolution Code</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-bookmark text-muted"></i>
											</div> -->
										</div>
									</div>
									<div class="mb-3">
										<label class="form-label">Resolution Year</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="number"  class="form-control text-uppercase" maxlength="4" name="resolutionYear" required>										
										<div class="invalid-feedback">Enter Resolution Year</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-bookmark text-muted"></i>
											</div> -->
										</div>
									</div>

									<div class="mb-3">
										<label class="form-label">Academic Resolution File</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="file"  class="form-control text-uppercase" name="AcadfileResolution" id="fileResolution" accept=".pdf" required>										
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
								<button type="submit" class="btn btn-primary">Add Academic Resolution</button>
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