<?php include '../include/header.php'; ?>

<body class="bg-white">
	<!-- Main navbar -->
	<div class="navbar navbar-dark navbar-static py-2">
		<div class="container-fluid">
			<div class="navbar-brand">
				<a href="index.html" class="d-inline-flex align-items-center">
					<img src="../assets/images/logo_qalo.png" alt="">
					<img src="../assets/images/logo_cct-qalo_light.png" class="d-none d-sm-inline-block h-12px ms-1" alt="">
				</a>
			</div>

			<div class="d-flex justify-content-end align-items-center ms-auto">
				<ul class="navbar-nav flex-row">
					<li class="nav-item">
						<a href="login.php" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
							<div class="d-flex align-items-center mx-md-1">
							<i class="ph-user-circle"></i>
							<span class="d-none d-md-inline-block ms-2">Login</span>
						</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /main navbar -->

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					<!-- Login card -->
					<form class="login-form needs-validation" action="#" novalidate>
						<div class="card mb-0">
							<div class="card-body">
								<div class="text-center mb-3">
									<div class="d-inline-flex align-items-center justify-content-center mb-2">
										<img src="../assets/images/logo_qalo.png" class="h-80px" alt="">
									</div>
									<h5 class="mb-0">Password recovery</h5>
									<span class="d-block text-muted">We'll send you instructions in email</span>
								</div>

								<div class="mb-3">
									<label class="form-label">Recovery Email Address</label>
									<div class="form-control-feedback form-control-feedback-start input-group">
										<input type="text" class="form-control" placeholder="Recovery Email" required>										
										<div class="invalid-feedback">Enter your Email</div>
										<div class="form-control-feedback-icon">
											<i class="ph-envelope text-muted"></i>
										</div>
									</div>
								</div>								

								<div class="mb-3">
									<button type="submit" class="btn btn-primary w-100">
										<i class="ph-arrow-counter-clockwise me-2"></i>
										Reset password
									</button>															
								</div>							
								<span class="form-text text-center text-muted">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
							</div>
						</div>
					</form>
					<!-- /login card -->
				</div>
				<!-- /content area -->			 


				<!-- Footer -->
				
				<!-- /footer -->

			</div>
			<!-- /inner content -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html>


 				