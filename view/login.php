<?php include '../include/header.php'; ?>
<?php include '../include/scripts.php'; ?>
<body class="bg-dark">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

  					
					
					<!-- Login card -->
					<form class="login-form" action="../controller/loginController.php" method="POST">
						<div class="card mb-0">
							<div class="card-body">
								<?php if (!empty($error)): ?>
									<div class="alert alert-danger">
										<span class="fw-semibold" style="color:red;"><?php echo $error; ?></span>
									</div>
								<?php endif; ?>
								<div class="text-center mb-3">
									<!-- <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
										<img src="assets/images/logo_icon.svg" class="h-48px" alt="">
									</div> -->
									<h1 class="mb-0">CCT- QALO</h1>
									<!-- <span class="d-block text-muted">Enter your credentials below</span> -->
								</div>

								<div class="mb-3">
									<label class="form-label">Email Address</label>
									<div class="form-control-feedback form-control-feedback-start">										
										<div class="input-group">											
											<input type="text" class="form-control" name="email" require>
											<span class="input-group-text bg-primary bg-opacity-20 text-primary">@citycollegeoftagaytay.edu.ph</span>
											<div class="form-control-feedback-icon">
											<i class="ph-user-circle text-muted"></i>
										</div>
										</div>
									</div>
								</div>



								<div class="mb-3">
									<label class="form-label">Password</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input type="password" class="form-control" placeholder="•••••••••••" name="password" require>
										<div class="form-control-feedback-icon">
											<i class="ph-lock text-muted"></i>
										</div>
									</div>
								</div>

								<div class="d-flex align-items-center mb-3">
									<label class="form-check">
										<input type="checkbox" name="remember" class="form-check-input" checked>
										<span class="form-check-label">Remember</span>
									</label>

									<a href="#" class="ms-auto">Forgot password?</a>
								</div>

								<div class="mb-3">
									<button type="submit" class="btn btn-primary w-100">Sign in</button>
								</div>

								<!-- <div class="text-center text-muted content-divider mb-3">
									<span class="px-2">or sign in with</span>
								</div>

								<div class="text-center mb-3">
									<button type="button" class="btn btn-outline-primary btn-icon rounded-pill border-width-2"><i class="ph-facebook-logo"></i></button>
									<button type="button" class="btn btn-outline-pink btn-icon rounded-pill border-width-2 ms-2"><i class="ph-dribbble-logo"></i></button>
									<button type="button" class="btn btn-outline-secondary btn-icon rounded-pill border-width-2 ms-2"><i class="ph-github-logo"></i></button>
									<button type="button" class="btn btn-outline-info btn-icon rounded-pill border-width-2 ms-2"><i class="ph-twitter-logo"></i></button>
								</div> -->

								<!-- <div class="text-center text-muted content-divider mb-3">
									<span class="px-2">Don't have an account?</span>
								</div>

								<div class="mb-3">
									<a href="#" class="btn btn-light w-100">Sign up</a>
								</div> -->

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
