				<!-- Vertical form modal -->
						<div id="modal_form_vertical" class="modal fade" tabindex="-1">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Vertical form</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>

									<form action="#">
										<div class="modal-body">
											<div class="mb-3">
												<div class="row">
													<div class="col-sm-6">
														<label class="form-label">First name</label>
														<input type="text" placeholder="Eugene" class="form-control">
													</div>

													<div class="col-sm-6">
														<label class="form-label">Last name</label>
														<input type="text" placeholder="Kopyov" class="form-control">
													</div>
												</div>
											</div>

											<div class="mb-3">
												<div class="row">
													<div class="col-sm-6">
														<label class="form-label">Address line 1</label>
														<input type="text" placeholder="Ring street 12" class="form-control">
													</div>

													<div class="col-sm-6">
														<label class="form-label">Address line 2</label>
														<input type="text" placeholder="building D, flat #67" class="form-control">
													</div>
												</div>
											</div>

											<div class="mb-3">
												<div class="row">
													<div class="col-sm-4">
														<label class="form-label">City</label>
														<input type="text" placeholder="Munich" class="form-control">
													</div>

													<div class="col-sm-4">
														<label class="form-label">State/Province</label>
														<input type="text" placeholder="Bayern" class="form-control">
													</div>

													<div class="col-sm-4">
														<label class="form-label">ZIP code</label>
														<input type="text" placeholder="1031" class="form-control">
													</div>
												</div>
											</div>

											<div>
												<div class="row">
													<div class="col-sm-6">
														<label class="form-label">Email</label>
														<input type="text" placeholder="eugene@kopyov.com" class="form-control">
														<div class="form-text text-muted">name@domain.com</div>
													</div>

													<div class="col-sm-6">
														<label class="form-label">Phone #</label>
														<input type="text" placeholder="+99-99-9999-9999" data-mask="+99-99-9999-9999" class="form-control">
														<div class="form-text text-muted">+99-99-9999-9999</div>
													</div>
												</div>
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Submit form</button>
										</div>
									</form>
								</div>
							</div>
						</div>
	<!-- /vertical form modal -->


	<!-- Accreditation Modal -->
	<div id="modal_accreditation" class="modal fade" data-bs-backdrop="false" tabindex="-1">
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
	<div id="modal_area" class="modal fade" data-bs-backdrop="false" tabindex="-1">
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
	<div id="modal_summaryreq" class="modal fade" data-bs-backdrop="false" tabindex="-1">
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
											<div class="form-control-feedback-icon">
												<i class="ph-briefcase text-muted"></i>
											</div>
										</div>
									</div>

									
									<div class="mb-3">
										<label class="form-label">Requirements</label>
										<div class="form-control-feedback form-control-feedback-start input-group">
											<input type="text"  class="form-control text-uppercase" name="codeName" required>										
										<div class="invalid-feedback">Enter Requirements</div>
											<div class="form-control-feedback-icon">
												<i class="ph-handshake text-muted"></i>
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
<!-- /Summary Requirements Modal -->