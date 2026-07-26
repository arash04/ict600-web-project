<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Coding Academy Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#161b22;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?=
                                                    session()->get('isLoggedIn')
                                                        ? (session()->get('user_role') === 'admin'
                                                            ? base_url('/admin/dashboard')
                                                            : base_url('/student/dashboard'))
                                                        : base_url('/')
                                                    ?>">
                Ahad Code
            </a>
            <div>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <?php if (session()->get('isLoggedIn')): ?>

                            <!-- STUDENT -->
                            <?php if (session()->get('user_role') === 'student'): ?>

                                <li class="nav-item">
                                    <a class="nav-link" href="/student/dashboard">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/student/courses">Courses</a>
                                </li>

                                <?php if (!session()->get('hasEnrolment')): ?>
                                    <!-- First time / no payment -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="/student/enrol">Package</a>
                                    </li>
                                <?php else: ?>
                                    <!-- After payment -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="/student/enrolment">My Enrolment</a>
                                    </li>
                                <?php endif; ?>

                                <li class="nav-item">
                                    <a class="nav-link" href="/student/profile">My Profile</a>
                                </li>

                                <!-- ADMIN -->
                            <?php else: ?>

                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/tutors">Manage Tutors</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/course">Manage Course</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/students">Manage Students</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/report">Report</a>
                                </li>

                            <?php endif; ?>
                            <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                        <?php else: ?>

                            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="/policy">Policy</a></li>
                            <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                            <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>

                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">