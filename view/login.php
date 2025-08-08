<?php 
session_start();
include '../include/header.php'; ?>

<body class="bg-dark">
	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">
					<div class="card mb-0">
						<div class="card-body">	
								<?php if (!empty($_GET['error'])): ?>
									<div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
									<?php //unset($_SESSION['error']); ?>
								<?php endif; ?>
								<?php if (!empty($_GET['success'])): ?>
									<div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
									<?php //unset($_SESSION['success']); ?>
								<?php endif; ?>
					<!-- Login card -->
							<form class="login-form needs-validation" action="../controller/userController.php" novalidate method="POST">							
								<div class="text-center mb-3">
									<div class="d-inline-flex align-items-center justify-content-center mb-2">
										<img src="../assets/images/logo_qalo.png" class="h-80px" alt="">
									</div>
									<h5 class="mb-0">Login to your account</h5>
									<span class="d-block text-muted">CCT-QALO FMS</span>
								</div>
									<input type="hidden" name="action" value="login">
								<div class="mb-3">
									<label class="form-label">Email Address</label>
									<div class="form-control-feedback form-control-feedback-start input-group">
										<input type="text" name="email" class="form-control" placeholder="••••••••" required>
										<span class="input-group-text">@citycollegeoftagaytay.edu.ph</span>
										<div class="invalid-feedback">Enter your Email</div>
										<div class="form-control-feedback-icon">
											<i class="ph-envelope text-muted"></i>
										</div>
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Password</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input type="password" name="password" class="form-control" placeholder="•••••••••••" required>
										<div class="invalid-feedback">Enter your Password</div>
										<div class="form-control-feedback-icon">
											<i class="ph-lock text-muted"></i>
										</div>
									</div>
									<div class="invalid-feedback">Enter your password</div>
								</div>

								<div class="d-flex align-items-center mb-3">
									<!-- <label class="form-check">
										<input type="checkbox" name="remember" class="form-check-input">
										<span class="form-check-label">Remember</span>
									</label> -->								
									<a href="recovery_password.php" class="ms-auto" >Forgot password?</a>
								</div>
								

								<div class="mb-3">
									<button type="submit" class="btn btn-primary w-100">Sign in</button>
								</div>
								<span class="form-text text-center text-muted">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
							</div>
						</div>
					</form>
					<!-- /login card -->
				</div>
				<!-- /content area -->		 
			</div>
			<!-- /inner content -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html>


 				