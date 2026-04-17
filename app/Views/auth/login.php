<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0 text-center fw-bold">Login to Your Account</h5>
            </div>
            <div class="card-body p-4">
                
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger mb-4">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success mb-4">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                            <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" 
                                   placeholder="name@example.com" value="<?= old('email') ?>" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-lock text-muted"></i></span>
                            <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" 
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary py-2 fw-bold">Sign In</button>
                    </div>
                </form>

            </div>
            <div class="card-footer bg-light py-3 border-0 text-center">
                <p class="mb-0 small text-muted">Don't have an account? Contact your administrator.</p>
            </div>
        </div>
        
        <div class="mt-4 text-center">
            <p class="text-muted small">
                <strong>Demo Login:</strong><br>
                Admin: <code>admin@school.edu</code><br>
                Teacher: <code>teacher@school.edu</code><br>
                Coordinator: <code>coordinator@school.edu</code><br>
                Password: <code>Password1</code>
            </p>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
