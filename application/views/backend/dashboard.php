<main id="main" class="main">
    <?php if ($level_name == 'pemasok'): ?>
        <div class="pagetitle">
            <h1>Dashboard Pemasok</h1>
        </div>
    <?php elseif ($level_name == 'pengelola'): ?>
        <div class="pagetitle">
            <h1>Dashboard Pengelola</h1>
        </div>
    <?php endif; ?>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <?php if ($level_name == 'pemasok'): ?>
                        <div class="col-xxl-6 col-md-4">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Stok Belum Diambil</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= number_format($total_stok_belum_diambil) ?> /kg</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-md-4">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Stok Sudah Diambil</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= number_format($total_stok_sudah_diambil) ?> /kg</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($level_name == 'pengelola'): ?>
                        <div class="col-xxl-6 col-md-4">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Stok Ban Bekas</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= number_format($total_ambil) ?> /kg</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-md-4">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Stok yang Sudah Diolah</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-arrow-up-circle"></i> <!-- Icon sesuai konteks -->
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= number_format($total_diolah) ?> /kg</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Laporan Data -->
                    <?php if ($level_name == 'pemasok'): ?>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Laporan Data <span>/bulan</span></h5>
                                    <div id="reportsChartPemasok"></div>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($level_name == 'pengelola'): ?>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Laporan Data <span>/bulan</span></h5>
                                    <div id="reportsChartPengelola"></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php if ($level_name == 'pemasok'): ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            var stok = <?= $stok ?>;
            var bulan = <?= $bulan ?>;

            console.log(stok, bulan); // Debugging

            new ApexCharts(document.querySelector("#reportsChartPemasok"), {
                series: [{
                    name: 'Stok',
                    data: stok,
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                },
                markers: {
                    size: 4
                },
                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    type: 'category',
                    categories: bulan
                },
                tooltip: {
                    x: {

                    },
                }
            }).render();
        });
    </script>
<?php elseif ($level_name == 'pengelola'): ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            var stok_diambil = <?= $stok_diambil ?>;
            var stok_diolah = <?= $stok_diolah ?>;
            var bulan = <?= $bulan ?>;

            console.log(stok_diambil, stok_diolah, bulan); // Debugging

            new ApexCharts(document.querySelector("#reportsChartPengelola"), {
                series: [{
                        name: 'Stok Diambil',
                        data: stok_diambil,
                    },
                    {
                        name: 'Stok Diolah',
                        data: stok_diolah,
                    }
                ],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                },
                markers: {
                    size: 4
                },
                colors: ['#4154f1', '#ff771d'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    type: 'category',
                    categories: bulan
                },
                tooltip: {
                    x: {},
                }
            }).render();
        });
    </script>
<?php else: ?>
    <!-- Script disabled for this user level -->
    <!--
    <script>
        // Code commented out for non-pemasok and non-pengelola users
    </script>
    -->
<?php endif; ?>