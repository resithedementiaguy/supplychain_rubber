<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Tambah Stok Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('pemasok'); ?>">Pemasok</a></li>
                </li>
                <li class="breadcrumb-item active">Tambah Stok</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header text-white bg-info">
            <p class="h5 pt-1">Tambah Stok Ban Bekas</p>
        </div>
        <div class="card-body">
            <div class="alert alert-info mb-0">
                Silahkan untuk mengisi semua form yang ada di bawah!
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
                    <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                    <select class="form-select" id="jenis_kendaraan" name="jenis_kendaraan" required>
                        <option value="">- Pilih Jenis Kendaraan -</option>
                        <option value="Mobil">Mobil</option>
                        <option value="Motor">Motor</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="jumlah_stok" class="form-label">Jumlah Stok (kg)</label>
                    <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" placeholder="Masukkan Jumlah Stok" required>
                </div>
                <div class="col-12">
                    <label for="harga_ban" class="form-label">Harga Ban Bekas per kg</label>
                    <input
                        type="text"
                        class="form-control"
                        id="harga_ban"
                        name="harga_ban"
                        placeholder="Rp0"
                        readonly>
                </div>
                <div class="col-12">
                    <label for="total_harga" class="form-label">Total Harga Ban Bekas</label>
                    <input type="text" class="form-control" id="total_harga" name="total_harga" placeholder="Rp0" readonly>
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

<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data berhasil disimpan.
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('pemasok'); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("DOMContentLoaded triggered");
        <?php if ($this->session->flashdata('success')): ?>
            console.log("Flashdata success exists");
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        <?php endif; ?>
    });
</script>

<script>
    document.getElementById('jenis_kendaraan').addEventListener('change', function() {
        const jenis = this.value;

        if (jenis) {
            fetch(`<?= base_url('pemasok/get_harga/') ?>${jenis}`)
                .then(response => response.json())
                .then(data => {
                    if (data.harga) {
                        document.getElementById('harga_ban').value = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        }).format(data.harga);

                        calculateTotal();
                    }
                });
        }
    });

    document.getElementById('jumlah_stok').addEventListener('input', calculateTotal);

    function calculateTotal() {
        const hargaBan = parseFloat(document.getElementById('harga_ban').value.replace(/[^\d]/g, '')) || 0;
        const jumlahStok = parseFloat(document.getElementById('jumlah_stok').value) || 0;

        const totalHarga = hargaBan * jumlahStok;

        document.getElementById('total_harga').value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(totalHarga);
    }

    // Get the user's location using the Geolocation API
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const locationValue = position.coords.latitude + ',' + position.coords.longitude;
            document.getElementById('location').value = locationValue;
        }, function() {
            console.error("Unable to retrieve your location");
        });
    } else {
        console.error("Geolocation is not supported by this browser.");
    }

    // Format Tanggal Dinamis
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
</script>