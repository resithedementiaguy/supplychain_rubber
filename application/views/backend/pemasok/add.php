<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Stok Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pemasok</li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tambah Stok</h5>
            <form class="row g-3" method="post" action="<?= base_url('pemasok/add') ?>">
                <div class="col-12">
                    <input type="hidden" name="id_pemasok" id="id_pemasok" value="<?= $this->session->userdata('mitra_id') ?>">
                </div>
                <div class="col-12">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $tgl = date('Y-m-d H:i:s', time());
                    ?>
                    <input type="text" class="form-control" id="tanggal" value="<?= $tgl ?>" placeholder="Tanggal" readonly>
                </div>
                <div class="col-12">
                    <label for="jumlah_stok" class="form-label">Jumlah Stok (kg)</label>
                    <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" placeholder="Jumlah Stok (kg)" required>
                </div>
                <div class="col-12">
                    <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                    <select class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" required>
                        <option value="">Pilih Jenis Kendaraan</option>
                        <option value="Mobil">Mobil</option>
                        <option value="Motor">Motor</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="harga_ban" class="form-label">Harga Ban</label>
                    <input type="number" class="form-control" id="harga_ban" name="harga_ban" placeholder="Harga Ban (IDR)" required>
                </div>

                <!-- Hidden input for location -->
                <input type="hidden" name="location" id="location">

                <div class="col-12 mt-5 d-flex justify-content-between align-items-center">
                    <a class="btn btn-secondary" href="<?= base_url('pemasok'); ?>">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
</main>