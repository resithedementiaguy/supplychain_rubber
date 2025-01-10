<main id="main" class="main">
    <?php if ($level_name == 'pemasok'): ?>
        <div class="pagetitle">
            <h1>Dashboard Pemasok</h1>
        </div>
    <?php elseif ($level_name == 'pengelola'): ?>
        <div class="pagetitle">
            <h1>Dashboard Pengelola</h1>
        </div>
    <?php elseif ($level_name == 'admin'): ?>
        <div class="pagetitle">
            <h1>Dashboard Admin</h1>
        </div>
    <?php endif; ?>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <section class="section dashboard">
        <div id="map" style="height: 600px;"></div>

        <script>
            // Data GeoJSON kecamatan
            const semarangGeoJSON = {
                "type": "FeatureCollection",
                "features": [{
                    "type": "Feature",
                    "properties": {
                        "name": "Alabama",
                        "density": 94.65
                    },
                    "geometry": {
                        "type": "Polygon",
                        "coordinates": [
                            [
                                [-87.359296, 35.00118],
                                [-85.606675, 34.984749],
                                [-85.431413, 34.124869],
                                [-85.184951, 32.859696],
                                [-85.069935, 32.580372],
                                [-84.960397, 32.421541],
                                [-85.004212, 32.322956],
                                [-84.889196, 32.262709],
                                [-85.058981, 32.13674],
                                [-85.053504, 32.01077],
                                [-85.141136, 31.840985],
                                [-85.042551, 31.539753],
                                [-85.113751, 31.27686],
                                [-85.004212, 31.003013],
                                [-85.497137, 30.997536],
                                [-87.600282, 30.997536],
                                [-87.633143, 30.86609],
                                [-87.408589, 30.674397],
                                [-87.446927, 30.510088],
                                [-87.37025, 30.427934],
                                [-87.518128, 30.280057],
                                [-87.655051, 30.247195],
                                [-87.90699, 30.411504],
                                [-87.934375, 30.657966],
                                [-88.011052, 30.685351],
                                [-88.10416, 30.499135],
                                [-88.137022, 30.318396],
                                [-88.394438, 30.367688],
                                [-88.471115, 31.895754],
                                [-88.241084, 33.796253],
                                [-88.098683, 34.891641],
                                [-88.202745, 34.995703],
                                [-87.359296, 35.00118]
                            ]
                        ]
                    }
                }]
            };

            // Fungsi untuk menentukan warna berdasarkan kondisi
            function getColor(condition) {
                return condition === "baik" ? "green" :
                    condition === "sedang" ? "yellow" :
                    condition === "buruk" ? "red" : "gray";
            }

            // Inisialisasi peta
            const map = L.map('map').setView([-7.005, 110.414], 12);

            // Tambahkan tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Tambahkan layer choropleth
            L.geoJSON(semarangGeoJSON, {
                style: function(feature) {
                    return {
                        color: "black",
                        weight: 2,
                        fillColor: getColor(feature.properties.condition),
                        fillOpacity: 0.5
                    };
                },
                onEachFeature: function(feature, layer) {
                    layer.bindPopup(`<b>${feature.properties.name}</b><br>Kondisi: ${feature.properties.condition}`);
                }
            }).addTo(map);

            // Tambahkan legenda
            const legend = L.control({
                position: "bottomright"
            });

            legend.onAdd = function(map) {
                const div = L.DomUtil.create('div', 'info legend');
                const conditions = ["baik", "sedang", "buruk"];
                const colors = ["green", "yellow", "red"];
                let labels = "<strong>Kondisi Udara</strong><br>";

                conditions.forEach((condition, i) => {
                    labels += `<i style="background: ${colors[i]}; width: 20px; height: 20px; display: inline-block;"></i> ${condition}<br>`;
                });

                div.innerHTML = labels;
                return div;
            };

            legend.addTo(map);
        </script>
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
                                            <i class="bi bi-arrow-up-circle"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= number_format($total_diolah) ?> /kg</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($level_name == 'admin'): ?>
                        <div class="col-xxl-12 col-md-6">
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

                        <div class="col-xxl-12 col-md-6">
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

                        <div class="col-xxl-12 col-md-6">
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

                        <div class="col-xxl-12 col-md-6">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Stok yang Sudah Diolah</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-arrow-up-circle"></i>
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