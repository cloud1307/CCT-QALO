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
											<input type="text" name="accreditation" class="form-control text-uppercase"  required>										
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
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text" name="accreditation" class="form-control text-uppercase"  required>										
										<div class="invalid-feedback">Enter School</div>
											<!-- <div class="form-control-feedback-icon">
												<i class="ph-house-line text-muted"></i>
											</div> -->
										</div>
									</div>
									
									<div class="mb-3">
										<label class="form-label">School Code</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text"  class="form-control text-uppercase" name="codeName" required>										
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