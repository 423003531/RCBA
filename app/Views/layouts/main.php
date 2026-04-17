<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My App - Role Based Access</title>
    <!-- We use Bootstrap because your Dashboard uses it -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { margin-bottom: 2rem; box-shadow: 0 2px 4px rgba(0,0,0,.05); }
    </style>
</head>
<body>
    <?php
            $role = session()->get('user')['role_name'] ?? '';

            if ($role === 'teacher') {
                $brandName = 'Teacher Portal';
                $brandUrl  = base_url('teacher-info');
                $navClass  = 'bg-dark'; 
            } elseif ($role === 'student') {
                $brandName = 'Student Portal';
                $brandUrl  = base_url('student-info');
                $navClass  = 'bg-dark';
            } elseif ($role === 'admin') {
                $brandName = 'Admin Portal';
                $brandUrl  = base_url('admin-info');
                $navClass  = 'bg-dark';  
            } elseif ($role === 'coordinator') {
                $brandName = 'Coordinator Portal';
                $brandUrl  = base_url('coordinator-info');
                $navClass  = 'bg-dark';    
            } else {
                $brandName = 'RBAC App Admin';
                $brandUrl  = base_url();
                $navClass  = 'bg-dark';  
            }
        ?>

        <nav class="navbar navbar-expand-lg navbar-dark <?= $navClass ?> shadow-sm mb-4">
            <div class="container">
                <a class="navbar-brand fw-bold" href="<?= $brandUrl ?>">
                    <i class="bi bi-shield-check me-2"></i> <?= $brandName ?>
                </a>


        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">



        <?php if ((session()->get('user')['role_name'] ?? '') === 'teacher'): ?>
            <li class='nav-item'>
                <a class="nav-link <?= url_is('teacher-info*') ? 'active fw-bold text-info' : 'text-white-50' ?>" href="<?= base_url('teacher-info') ?>">
                    <i class="bi bi-speedometer2 me-1"></i>Teacher Info
                </a>
            </li>
        <?php elseif ((session()->get('user')['role_name'] ?? '') === 'student'): ?>
            <li class="nav-item">
                <a class="nav-link <?= url_is('student-info*') ? 'active fw-bold text-info' : 'text-white-50' ?>" href="<?= base_url('student-info') ?>">
                    <i class="bi bi-house me-1"></i>Student Info
                </a>
            </li>
        <?php elseif ((session()->get('user')['role_name'] ?? '') === 'coordinator'): ?>
            <li class="nav-item">
                <a class="nav-link <?= url_is('coordinator-info*') ? 'active fw-bold text-info' : 'text-white-50' ?>" href="<?= base_url('coordinator-info') ?>">
                    <i class="bi bi-person-workspace me-1"></i>Coordinator Info
                </a>
            </li>
        <?php endif; ?>





            <!-- ROLE BASED LINKS -->
            <?php if ((session()->get('user')['role_name'] ?? '') === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link <?= url_is('admin/roles*') ? 'active fw-bold text-warning border-bottom border-warning' : 'text-white-50' ?>" 
                       href="<?= base_url('/admin/roles') ?>">
                        Role Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (url_is('admin/users*') && !url_is('admin/users/edit*')) ? 'active fw-bold text-warning border-bottom border-warning' : 'text-white-50' ?>" 
                       href="<?= base_url('/admin/users') ?>">
                        User Management
                    </a>
                </li>
            <?php endif; ?>

            <?php if (in_array(session()->get('user')['role_name'] ?? '', ['teacher', 'admin'])): ?>
                <li class="nav-item ms-lg-2">
                    <a class="nav-link <?= url_is('management/students*') ? 'active fw-bold text-info border-bottom border-info' : 'text-white-50' ?>" 
                    href="<?= base_url('/management/students') ?>">
                        Student List
                    </a>
                </li>
            <?php endif; ?>

            <!-- 3. Teacher List (Active for Admin/Coordinator) -->
            <?php if (in_array(session()->get('user')['role_name'] ?? '', ['admin', 'coordinator'])): ?>
                <li class="nav-item ms-lg-2">
                    <a class="nav-link <?= url_is('admin/teachers*') ? 'active fw-bold text-success border-bottom border-success' : 'text-white-50' ?>" 
                    href="<?= base_url('/admin/teachers') ?>">
                        Teacher List
                    </a>
                </li>
            <?php endif; ?>

            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <!-- THIS IS THE MOST IMPORTANT PART: -->
    <!-- This is where dashboard.php and other views will be injected -->
    <?= $this->renderSection('content') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
