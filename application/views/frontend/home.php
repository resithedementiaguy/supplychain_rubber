<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <h1 class="sitename">Crumb Rubber</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home<br></a></li>
                    <li><a href="#proses">Proses</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted flex-md-shrink-0" href="<?= site_url('auth') ?>">Login</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 data-aos="fade-up">Pengembangan Teknologi Crumb Rubber dari Limbah Ban Bekas UMKM Repro</h1>
                        <p data-aos="fade-up" data-aos-delay="100">Mendukung Ekonomi Sirkular Berkelanjutan di Kota Semarang</p>
                        <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                            <a href="#proses" class="btn-get-started">Proses dan Teknologi</a>
                            <!-- <i class="bi bi-arrow-right"></i> -->
                            <!-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                        <img src="<?= base_url('assets/frontend') ?>/assets/img/rubber_crumb.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Values Section -->
        <section id="proses" class="values section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Proses dan teknologi</h2>
                <p>Apa Saja Proses dan Teknologi Crumb Rubber?<br></p>
            </div>

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 col-sm-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="card">
                            <img src="<?= base_url('assets/frontend') ?>/assets/img/ppp-01.jpg" alt="Ban Bekas">
                            <h3>Ban Bekas</h3>
                            <p>Ban bekas merupakan bahan utama dalam proses daur ulang untuk menghasilkan crumb rubber yang ramah lingkungan.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="card">
                            <img src="<?= base_url('assets/frontend') ?>/assets/img/ppp-02.jpg" alt="Aplikasi">
                            <h3>Aplikasi</h3>
                            <p>Platform digital yang membantu pengelolaan secara efisien, dari pengumpulan bahan mentah hingga distribusi produk jadi.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12" data-aos="fade-up" data-aos-delay="300">
                        <div class="card">
                            <img src="<?= base_url('assets/frontend') ?>/assets/img/ppp-03.jpg" alt="Alat Pencacah">
                            <h3>Alat Pencacah</h3>
                            <p>Mesin pencacah khusus yang digunakan untuk mengolah ban bekas menjadi crumb rubber.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Values Section -->

    </main>