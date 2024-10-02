<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Crumb Rubber</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('') ?>/assets/img/favicon.png" rel="icon">
    <link href="<?= base_url('') ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('') ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('') ?>/assets/css/style.css" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">Crumb Rubber</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url('') ?>/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $this->session->userdata('nama'); ?></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $this->session->userdata('nama'); ?></h6>
                            <span><?php echo $this->session->userdata('level_name'); ?></span>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo site_url('profile'); ?>">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>

    </header>

    <!-- Logout Confirmation Modal -->
    <div class="modal modal-borderless fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar dari akun ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo ($this->uri->segment(1) == 'dashboard') ? '' : 'collapsed'; ?>" href="<?php echo site_url('dashboard'); ?>">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php
            // Ambil level_name dari session
            $level_name = $this->session->userdata('level_name');

            // Jika level_name adalah "pemasok", hanya tampilkan item menu Pemasok
            if ($level_name == 'pemasok') : ?>
            <li class="nav-heading">Mitra</li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(1) == 'pemasok') ? '' : 'collapsed'; ?>" href="<?php echo site_url('pemasok'); ?>">
                        <i class="bi bi-person"></i>
                        <span>Pemasok</span>
                    </a>
                </li>
            <?php
            // Jika level_name adalah "pengelola", hanya tampilkan item menu Pengelola
            elseif ($level_name == 'pengelola') : ?>
            <li class="nav-heading">Mitra</li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(1) == 'pengelola') ? '' : 'collapsed'; ?>" href="<?php echo site_url('pengelola'); ?>">
                        <i class="bi bi-person"></i>
                        <span>Mitra Pengelola</span>
                    </a>
                </li>

                <?php
            // Jika level_name adalah "pengelola", hanya tampilkan item menu Pengelola
            elseif ($level_name == 'admin') : ?>
            <li class="nav-heading">Kelola Data</li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(1) == 'pengelola') ? '' : 'collapsed'; ?>" href="<?php echo site_url('admin/pengelola'); ?>">
                        <i class="bi bi-person"></i>
                        <span>Mitra Pengelola</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(1) == 'pemasok') ? '' : 'collapsed'; ?>" href="<?php echo site_url('admin/pemasok'); ?>">
                        <i class="bi bi-person"></i>
                        <span>Mitra Pemasok</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(1) == 'stok') ? '' : 'collapsed'; ?>" href="<?php echo site_url('admin/stok'); ?>">
                        <i class="bi bi-person"></i>
                        <span>Stok</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(1) == 'ambil') ? '' : 'collapsed'; ?>" href="<?php echo site_url('admin/ambil'); ?>">
                        <i class="bi bi-person"></i>
                        <span>Ambil</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(1) == 'olah') ? '' : 'collapsed'; ?>" href="<?php echo site_url('admin/olah'); ?>">
                        <i class="bi bi-person"></i>
                        <span>Pengolahan</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </aside>