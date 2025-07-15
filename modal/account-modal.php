<!-- Account Info Modal -->
<div id="modal-account" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="modal-body" action="#" method="post">
                <div class="text-center mb-3">
                    <div class="d-inline-flex bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-3 mb-3 mt-1">
                        <img src="../assets/images/logo_qalo.png" class="h-80px" alt="">
                    </div>
                    <h5 class="mb-0">User Account</h5>
                    <span class="d-block text-muted">
                        Hello, <?= htmlspecialchars(strtoupper($_SESSION['user_level'] ?? 'GUEST')) ?>
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" readonly
                        value="<?= htmlspecialchars($userData['varEmail'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" readonly
                        value="<?= htmlspecialchars($userData['varFirstname'] ?? '') . ' ' . htmlspecialchars($userData['varLastname'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Recovery Email</label>
                    <input type="email" class="form-control" readonly
                        value="<?= htmlspecialchars($userData['recovery_email'] ?? 'Not available') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact Number</label>
                    <input type="text" class="form-control" readonly
                        value="<?= htmlspecialchars($userData['contact_number'] ?? 'Not available') ?>">
                </div>

                <button type="button" class="btn btn-light w-100" data-bs-dismiss="modal">
                    <i class="ph-x-circle me-2"></i> Close
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /Account Info Modal -->
