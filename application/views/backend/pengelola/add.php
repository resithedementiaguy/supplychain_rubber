<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Ambil Stok Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pengelola</li>
                <li class="breadcrumb-item active">Ambil</li>
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

<!-- Modal untuk peringatan -->
<div class="modal fade" id="keteranganModal" tabindex="-1" role="dialog" aria-labelledby="keteranganModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="keteranganModalLabel">Peringatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Keterangan wajib diisi.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.ambilStokBtn').click(function() {
            var idPemasok = $(this).data('id');
            var jumlahStok = $(this).closest('tr').find('.jumlahStok').data('jumlah'); // Ambil jumlah stok dari tabel
            var keterangan = $('#keterangan').val();

            if (idPemasok && jumlahStok) {
                // Set hidden input untuk ID pemasok
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id_pemasok',
                    value: idPemasok
                }).appendTo('#ambilStokForm');

                // Set jumlah stok ke input
                $('#jumlah_stok').val(jumlahStok);

                // Kirim form
                $('#ambilStokForm').submit();
            } else {
                alert('Mohon lengkapi jumlah stok.');
            }
        });
    });

    $(document).ready(function() {
        $('#ambilStokForm').on('submit', function(event) {
            var keterangan = $('#keterangan').val();
            if (keterangan.trim() === '') {
                event.preventDefault(); // Mencegah pengiriman form
                $('#keteranganModal').modal('show'); // Tampilkan modal
            }
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
</script>