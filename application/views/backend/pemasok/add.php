<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Tambah Stok Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pemasok</li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header text-white bg-info">
            <p class="h5 py-1">Tambah Stok Ban Bekas</p>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                *Silahkan untuk mengisi semua form yang ada di bawah!
            </div>
            <form class="row g-3" method="post" action="<?= base_url('pemasok/add') ?>">
                <div class="col-12">
                    <input type="hidden" name="id_pemasok" id="id_pemasok" value="<?= $this->session->userdata('mitra_id') ?>">
                </div>
                <div class="col-12">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="text" class="form-control" id="tanggal" placeholder="Tanggal" readonly>
                </div>
                <div class="col-12">
                    <label for="jumlah_stok" class="form-label">Jumlah Stok (kg)</label>
                    <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" placeholder="Masukkan Jumlah Stok" required>
                </div>
                <div class="col-12">
                    <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                    <select class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" required>
                        <option value="">- Pilih Jenis Kendaraan -</option>
                        <option value="Mobil">Mobil</option>
                        <option value="Motor">Motor</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="harga_ban" class="form-label">Harga Ban Bekas (kg)</label>
                    <input
                        type="text"
                        class="form-control"
                        id="harga_ban"
                        name="harga_ban"
                        placeholder="Masukkan Harga Ban Bekas"
                        required
                        oninput="formatRupiah(this)">
                </div>

                <!-- Hidden input for location -->
                <input type="hidden" name="location" id="location">

                <div class="col-12 mt-5 d-flex justify-content-between align-items-center">
                    <a class="btn btn-secondary" href="<?= base_url('pemasok'); ?>">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>

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

    function updateTanggal() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        const formattedDate = `${year}-${month}-${day}, ${hours}:${minutes}:${seconds} WIB`;

        document.getElementById('tanggal').value = formattedDate;
    }

    setInterval(updateTanggal, 1000);

    updateTanggal();

    function formatRupiah(element) {
        let value = element.value.replace(/[^\d]/g, "");
        element.value = value ? "Rp" + parseInt(value).toLocaleString("id-ID") : "";
    }

    $(document).ready(function() {
        $("#submitHarga").click(function() {
            // Ambil nilai input dan hapus format "Rp" serta pemisah ribuan
            let hargaBan = $("#harga_ban").val().replace(/[^\d]/g, "");

            if (hargaBan) {
                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    url: "<?= base_url('pemasok/simpan_harga_ban'); ?>",
                    type: "POST",
                    data: {
                        harga_ban: hargaBan
                    },
                    success: function(response) {
                        alert("Harga berhasil disimpan!");
                        $("#harga_ban").val("");
                    },
                    error: function() {
                        alert("Gagal menyimpan harga. Silakan coba lagi.");
                    }
                });
            } else {
                alert("Harap masukkan harga ban bekas.");
            }
        });
    });
</script>