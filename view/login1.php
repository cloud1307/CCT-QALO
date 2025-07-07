<?php include '../include/header.php'; ?>
<body class="bg-dark">
<div class="page-content">
	<div class="content-wrapper">
		<div class="content-inner">
			<div class="content d-flex justify-content-center align-items-center">
				<!-- Login Form -->
				<form class="login-form" action="../controller/loginController.php" method="POST">
					<div class="card mb-0">
						<div class="card-body">
							<?php if (!empty($_GET['error'])): ?>
								<div class="alert alert-danger">
									<span class="fw-semibold text-danger"><?= htmlspecialchars($_GET['error']) ?></span>
								</div>
							<?php endif; ?>

							<div class="text-center mb-3">
								<h1 class="mb-0">CCT - QALO</h1>
							</div>

							<div class="mb-3">
								<label class="form-label">Email Address</label>
								<div class="input-group">
									<input type="text" class="form-control" name="email" required>
									<span class="input-group-text">@citycollegeoftagaytay.edu.ph</span>
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label">Password</label>
								<input type="password" class="form-control" name="password" required>
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

							<span class="form-text text-center text-muted">
								By continuing, you're confirming that you've read our 
								<a href="#">Terms &amp; Conditions</a> and 
								<a href="#">Cookie Policy</a>
							</span>
						</div>
					</div>
				</form>
				<!-- /Login Form -->
			</div>
		</div>
	</div>
</div>

</body>
</html>
