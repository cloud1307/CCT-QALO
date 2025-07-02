<?php 
	include '../include/header.php';
	include '../include/scripts.php';
?>

<body class="bg-dark">
<div class="container mt-4">
	<div class="row justify-content-center">
		<div class="col-md-5">
			<div class="card shadow">
				<div class="card-header text-center">
					<h1 class="mb-0">CCT - QALO FMS</h1>
				</div>
				<div class="card-body">
					<?php if (!empty($_GET['error'])): ?>
						<div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
						<?php //unset($_SESSION['error']); ?>
					<?php endif; ?>
					<?php if (!empty($_GET['success'])): ?>
						<div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
						<?php //unset($_SESSION['success']); ?>
					<?php endif; ?>
					<form action="../controller/loginController.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                                <div class="input-group">                            
                                    <input type="text" class="form-control" name="email" required>
                                    <span class="input-group-text">@citycollegeoftagaytay.edu.ph</span>
                                </div>
                        </div>
						<div class="mb-3">
                            <label>Password</label>
                                <div class="input-group">                                    
                                    <input type="password" name="password" class="form-control" required>
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
					</form>
						<span class="form-text text-center text-muted">
								By continuing, you're confirming that you've read our 
								<a href="#">Terms &amp; Conditions</a> and 
								<a href="#">Cookie Policy</a>
						</span>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
