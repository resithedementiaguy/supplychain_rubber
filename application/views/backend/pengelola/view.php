<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Mitra Pengelola</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item active">Mitra Pengelola</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Daftar History Pengelola</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            Silahkan untuk menambahkan dan mengecek stok crumb rubber
                        </div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <a class="btn btn-primary border-0" style="cursor: pointer;" href="<?= base_url('pengelola/add_view') ?>"><b>Ambil Stok</b></a>
                        </div>
                        <form action="<?= base_url('pengelola') ?>" method="POST">
                            <input type="hidden" value="<?php echo $this->session->userdata('mitra_id'); ?>" name="session_mitra_id" id="session_mitra_id">
                        </form>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Usaha</th>
                                        <th>Nomor HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($daftar_ambil)) : ?>
                                        <?php $no = 1;
                                        foreach ($daftar_ambil as $ambil) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $ambil->nama ?></td>
                                                <td><?= $ambil->nama_usaha ?></td>
                                                <td><?= $ambil->no_hp ?></td>
                                                <td>
                                                    <a class="btn btn-success btn-sm border-0" href="<?php echo site_url('pengelola/detail/' . $ambil->id); ?>"><i class="bi bi-eye"></i> Detail</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6" align="center">Tidak ada data ambil.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    function getPengelolaLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    var pengelola_lat = position.coords.latitude;
                    var pengelola_long = position.coords.longitude;

                    console.log("Lokasi pengelola: ", pengelola_lat, pengelola_long);

                    // Kirim koordinat ke server
                    $.ajax({
                        url: '<?= base_url("pengelola/update_location") ?>',
                        type: 'POST',
                        data: {
                            lat: pengelola_lat,
                            long: pengelola_long
                        },
                        success: function(response) {
                            console.log('Lokasi berhasil dikirim ke server:', response);
                        },
                        error: function(error) {
                            console.error('Error saat mengirim lokasi:', error);
                            alert('Gagal mengirim lokasi ke server.');
                        }
                    });
                },
                function(error) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            alert("Pengguna menolak permintaan Geolocation.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            alert("Informasi lokasi tidak tersedia.");
                            break;
                        case error.TIMEOUT:
                            alert("Permintaan lokasi pengguna kedaluwarsa.");
                            break;
                        case error.UNKNOWN_ERROR:
                            alert("Terjadi kesalahan yang tidak diketahui.");
                            break;
                    }
                }
            );
        } else {
            alert('Geolocation tidak didukung oleh browser ini.');
        }
    }

    // Jalankan fungsi saat halaman siap
    $(document).ready(function() {
        getPengelolaLocation();
    });
</script>