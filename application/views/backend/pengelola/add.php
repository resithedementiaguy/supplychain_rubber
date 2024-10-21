<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Ambil Stok Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item">Mitra Pengelola</li>
                <li class="breadcrumb-item active">Ambil Stok</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header text-white bg-info">
            <p class="h5 py-1">Daftar Pemasok (Berdasarkan Rute Optimal)</p>
        </div>
        <div class="card-body">
            <!-- Menampilkan Total Jarak -->
            <div class="alert alert-info">
                <strong>Total Jarak Keseluruhan: </strong> <?= number_format($total_distance, 2) ?> km
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Usaha</th>
                        <th>Lokasi</th>
                        <th>Berat Stok (kg)</th>
                        <th>Jarak (KM)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($nama_usaha)) : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($nama_usaha as $pemasok) : ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="selected_stok[]" value="<?= $pemasok->id; ?>">
                                    <?= $no++; ?>
                                </td>
                                <td><?= $pemasok->nama_usaha; ?></td>
                                <td><?= $pemasok->alamat; ?></td>
                                <td class="jumlahStok" data-jumlah="<?= $pemasok->jumlah_stok; ?>"><?= $pemasok->jumlah_stok; ?> kg</td>
                                <td><?= number_format($pemasok->distance, 2); ?> km</td>
                                <td>
                                    <a class="btn btn-primary openMapBtn" href="javascript:void(0)" data-koordinat="<?= $pemasok->lokasi ?>">Buka Maps</a>
                                    <button type="button" class="btn btn-success ambilStokBtn" data-id="<?= $pemasok->id; ?>">Ambil Stok</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada pemasok tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <form class="row g-3" id="ambilStokForm" method="post" action="<?= base_url('pengelola/add'); ?>">
                <div class="col-12">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="text" class="form-control" id="tanggal" placeholder="Tanggal" readonly>
                </div>
                <div class="col-12" style="display: none;">
                    <label for="jumlah_stok" class="form-label">Jumlah Stok (kg)</label>
                    <input type="hidden" class="form-control" id="jumlah_stok" name="jumlah_stok" placeholder="Jumlah Stok (kg)">
                </div>
                <div class="col-12">
                    <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan keterangan" required></textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-secondary" href="<?= base_url('pengelola'); ?>">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- Modal untuk konfirmasi pengambilan stok -->
<div class="modal fade" id="ambilStokModal" tabindex="-1" role="dialog" aria-labelledby="ambilStokModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ambilStokModalLabel">Konfirmasi Pengambilan Stok</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengambil stok ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="confirmAmbilStokBtn">Ya, Ambil Stok</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk peringatan -->
<div class="modal fade" id="keteranganModal" tabindex="-1" role="dialog" aria-labelledby="keteranganModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="keteranganModalLabel">Peringatan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Keterangan tidak boleh kosong!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk pesan berhasil -->
<div class="modal fade" id="berhasilAmbilStokModal" tabindex="-1" role="dialog" aria-labelledby="berhasilAmbilStokModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="berhasilAmbilStokModalLabel">Berhasil</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Stok berhasil diambil dari pemasok!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Okey</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Ketika tombol "Ambil Stok" ditekan
        $('.ambilStokBtn').click(function() {
            var idPemasok = $(this).data('id');
            var jumlahStok = $(this).closest('tr').find('.jumlahStok').data('jumlah');
            var keterangan = $('#keterangan').val(); // Ambil nilai keterangan

            // Periksa apakah keterangan kosong
            if (keterangan.trim() === '') {
                $('#keteranganModal').modal('show'); // Tampilkan modal peringatan
            } else if (idPemasok && jumlahStok) {
                // Simpan ID pemasok dan jumlah stok di modal konfirmasi
                $('#confirmAmbilStokBtn').data('id', idPemasok); // Simpan ID di button
                $('#confirmAmbilStokBtn').data('jumlah', jumlahStok); // Simpan jumlah stok

                // Tampilkan modal konfirmasi
                $('#ambilStokModal').modal('show');
            } else {
                alert('Mohon lengkapi jumlah stok.');
            }
        });

        // Ketika tombol "Ya, Ambil Stok" di modal ditekan
        $('#confirmAmbilStokBtn').click(function() {
            var idPemasok = $(this).data('id');
            var jumlahStok = $(this).data('jumlah');

            // Set hidden input untuk ID pemasok
            $('<input>').attr({
                type: 'hidden',
                name: 'id_pemasok',
                value: idPemasok
            }).appendTo('#ambilStokForm');

            // Set jumlah stok ke input hidden
            $('#jumlah_stok').val(jumlahStok);

            // Submit form setelah konfirmasi
            $('#ambilStokForm').submit();
        });

        // Tangani event submit untuk form ambil stok
        $('#ambilStokForm').on('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form default

            // Kirim data menggunakan AJAX
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(), // Mengirim data form
                success: function(response) {
                    // Sembunyikan modal konfirmasi sebelum menampilkan modal berhasil
                    $('#ambilStokModal').modal('hide'); // Hilangkan modal konfirmasi

                    // Jika berhasil, tampilkan modal berhasil
                    $('#berhasilAmbilStokModal').modal('show');
                },
                error: function(error) {
                    alert('Gagal mengambil stok. Silakan coba lagi.');
                }
            });
        });

        // Tangani event ketika modal berhasil ditutup
        $('#berhasilAmbilStokModal').on('hidden.bs.modal', function() {
            location.reload(); // Refresh halaman setelah modal ditutup
        });
    });

    // Fungsi untuk membuka Google Maps dengan koordinat dari tombol di tabel
    $(document).ready(function() {
        $(document).on('click', '.openMapBtn', function() {
            var koordinat = $(this).data('koordinat');
            if (koordinat) {
                const mapsUrl = `https://www.google.com/maps?q=${koordinat}&z=15&hl=id`;
                window.open(mapsUrl, '_blank'); // Buka Google Maps di tab baru
            } else {
                alert("Koordinat tidak tersedia.");
            }
        });
    });

    // Fungsi untuk tanggal dan jam dinamis
    $(document).ready(function() {
        function updateTanggal() {
            var now = new Date();
            var tgl = now.toISOString().slice(0, 19).replace('T', ' ');
            $('#tanggal').val(tgl);
        }

        updateTanggal();
        setInterval(updateTanggal, 1000);
    });

    // Ambil data session dari server
    var pengelola_lat = '<?= $pengelola_lat ?>';
    var pengelola_long = '<?= $pengelola_long ?>';

    // Tampilkan data di console log
    console.log("Lokasi pengelola: ", pengelola_lat, pengelola_long);
</script>