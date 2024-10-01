<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Register</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('') ?>assets/img/favicon.png" rel="icon">
    <link href="<?= base_url('') ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('') ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('') ?>assets/css/style.css" rel="stylesheet">

</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-12 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                                        <p class="text-center small">Masukkan informasi data Anda untuk membuat akun</p>
                                    </div>

                                    <form class="row g-3 needs-validation" action="<?= base_url('auth/register') ?>" method="POST" id="registrationForm">
                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" required>
                                            <div class="invalid-feedback">Please enter a valid Email address!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nama Pemilik</label>
                                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Pemilik" required>
                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nama Usaha</label>
                                            <input type="text" name="nama_usaha" class="form-control" id="nama_usaha" placeholder="Masukkan Nama Usaha" required>
                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>

                                        <div class="col-12">
                                            <label>Kategori Akun</label>
                                            <select class="form-control" name="level" id="level" required>
                                                <option value="" selected hidden>Pilih kategori akun yang akan dibuat</option>
                                                <option value="pemasok">Pemasok</option>
                                                <option value="pengelola">Pengelola Mitra</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nomor Telepon</label>
                                            <input type="number" name="no_hp" class="form-control" id="no_hp" placeholder="Masukkan Nomor Hp" required>
                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat" required>
                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>

                                        <!-- Hidden input for combined latitude and longitude -->
                                        <input type="hidden" name="location" id="location">

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Buat Password" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Sudah punya akun? <a href="<?= base_url('auth') ?>">Login sekarang!</a></p>
                                        </div>
                                    </form>

                                    <script>
                                        // Get the user's location using the Geolocation API
                                        if (navigator.geolocation) {
                                            navigator.geolocation.getCurrentPosition(function(position) {
                                                // Combine latitude and longitude into a single string
                                                const locationValue = position.coords.latitude + ',' + position.coords.longitude;
                                                // Set the combined value in the hidden input
                                                document.getElementById('location').value = locationValue;
                                            }, function() {
                                                console.error("Unable to retrieve your location");
                                            });
                                        } else {
                                            console.error("Geolocation is not supported by this browser.");
                                        }
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('') ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/quill/quill.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>