<?php 
session_start();
	include '../include/header.php';
	include '../include/scripts.php';
?>
<body class="bg-dark">

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card shadow">
				<div class="card-header text-center">
					<h4 class="mb-0">Create an Account</h4>
				</div>
				<div class="card-body">
					<?php if (!empty($_GET['error'])): ?>
						<div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
                        <?php unset($_SESSION['error']); ?>
					<?php endif; ?>
					<?php if (!empty($_GET['success'])): ?>
						<div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
                        <?php unset($_SESSION['success']); ?>
					<?php endif; ?>
					<form action="../controller/signupController.php" method="POST">
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
						
                        <div class="mb-3">
							<label>Confirm Password</label>
                                <div class="input-group">
							        <input type="password" name="confirm_password" class="form-control" required>
                                </div>
						</div>
						<div class="mb-3">
							<label>Recovery Email</label>
                                <div class="input-group">
							        <input type="email" name="recovery_email" class="form-control" required>
                                </div>
						</div>
						<div class="mb-3">
							<label>Contact Number</label>
                                <div class="input-group">
							        <input type="text" name="contact_number" class="form-control" required>
                                </div>
						</div>
						<button type="submit" class="btn btn-primary w-100">Sign Up</button>
					</form>
					<p class="text-center mt-3">Already registered? <a href="login.php">Login here</a></p>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
