<?php
require_once '../controller/sessionController.php';
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
// if (!isset($userData)) {
//     $userData = [];
// }
// echo "<pre>SESSION DATA:\n";
// print_r($_SESSION);
// echo "</pre>";

// try {
// 	$session = new Session();
// 	$data = $session->getSessionDetailsByUserId(1);
// 	echo "<pre>";
// 	print_r($data);
// 	echo "</pre>";
// } catch (Exception $e) {
// 	echo "Error: " . $e->getMessage();
// }
?>
<?php	include '../modal/modal.php'; ?>
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
							Hi!, <?= htmlspecialchars(isset($userData['enumUserLevel']) ? $userData['enumUserLevel'] : 'Not available') ?>						
						</span>
					</a>
 					
					<div class="dropdown-menu dropdown-menu-end">						   
						<a href="#modal-account" class="dropdown-item" data-bs-toggle="modal">
							<i class="ph-user-circle me-2"></i>
							My profile
						</a>
						<!-- <a href="#" data-bs-toggle="modal" data-bs-target="#modal-account">
   						 	<i class="ph-user-circle me-2"></i> My Account
						</a> -->
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



				