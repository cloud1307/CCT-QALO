<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
?>
	<!-- Main navbar -->
	<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
		<div class="container-fluid">
			<div class="d-flex d-lg-none me-2">
				<button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
					<i class="ph-list"></i>
				</button>
			</div>

			<div class="navbar-brand flex-1 flex-lg-0">
				<a href="dashboard.php" class="d-inline-flex align-items-center">
					<img src="../assets/images/logo_qalo.png" alt="">
					<img src="../assets/images/logo_cct-qalo_light.png" class="d-none d-sm-inline-block h-12px ms-1" alt="">
				</a>
			</div>



			<ul class="nav flex-row justify-content-end order-1 order-lg-2">		
				<li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
					<a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
						<div class="status-indicator-container">
							<img src="../assets/images/demo/users/face11.jpg" class="w-32px h-32px rounded-pill" alt="">
							<span class="status-indicator bg-success"></span>
						</div>
						<span class="d-none d-lg-inline-block mx-lg-2">
							<?= htmlspecialchars(strtoupper($_SESSION['user_level'] ?? '')) ?>						
						</span>
					</a>

					<div class="dropdown-menu dropdown-menu-end">
						    <?php	include '../modal/modal.php'; ?>
						<a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-account">
							<i class="ph-user-circle me-2"></i>
							My profile
						</a>
						<a href="#" class="dropdown-item">
							<i class="ph-envelope-open me-2"></i>
							My inbox
							<!-- <span class="badge bg-primary rounded-pill ms-auto">26</span> -->
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="ph-gear me-2"></i>
							Account settings
						</a>
						<a href="../controller/userController.php?action=logout" class="dropdown-item">
							<i class="ph-sign-out me-2"></i>
							Logout
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->



				<!-- Password recovery form -->
					<div id="modal-account" class="modal fade" tabindex="-1">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">

								<!-- Form -->
								<form class="modal-body" action="index.html">
									<div class="text-center mb-3">
										<div class="d-inline-flex bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-3 mb-3 mt-1">
											<img src="../assets/images/logo_qalo.png" class="h-80px" alt="">
										</div>
										<h5 class="mb-0">User Account</h5>
										<span class="d-block text-muted">Hello!,<?= htmlspecialchars(strtoupper($_SESSION['user_level'] ?? '')) ?>	</span>
									</div>

									<div class="mb-3">
										<label class="form-label">Your Email Address</label>
										<div class="form-control-feedback form-control-feedback-start">
											<input type="email" class="form-control" placeholder="john@doe.com" name="recovery_email" value="<?= htmlspecialchars($_SESSION['user_email'] ?? '') ?>	">
											<div class="form-control-feedback-icon">
												<i class="ph-envelope text-muted"></i>
											</div>
										</div>
									</div>

									<div class="mb-3">
										<label class="form-label">Password</label>
										<div class="form-control-feedback form-control-feedback-start">
											<input type="password" class="form-control" name="password">
											<div class="form-control-feedback-icon">
												<i class="ph-lock text-muted"></i>
											</div>
										</div>
									</div>

									<div class="mb-3">
										<label class="form-label">Recovery Email Address</label>
										<div class="form-control-feedback form-control-feedback-start">
											<input type="text" class="form-control" name="recovery_email"  value="<?= htmlspecialchars($_SESSION['varEmail'] ?? '') ?>">
											<div class="form-control-feedback-icon">
												<i class="ph-envelope text-muted"></i>
											</div>
										</div>
									</div>

									<div class="mb-3">
										<label class="form-label">Contact Number</label>
										<div class="form-control-feedback form-control-feedback-start">
											<input type="password" class="form-control" name="password">
											<div class="form-control-feedback-icon">
												<i class="ph-phone text-muted"></i>
											</div>
										</div>
									</div>

									<button type="submit" class="btn btn-primary w-100">
										<i class="ph-arrow-counter-clockwise me-2"></i>
										Reset password
									</button>
								</form>
								<!-- /form -->

							</div>
						</div>
					</div>
					<!-- /password recovery form -->