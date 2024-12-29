<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Ambil Stok Dari Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('pengelola'); ?>">Mitra Pengelola</a></li>
                <li class="breadcrumb-item active">Ambil Stok</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header text-white bg-info">
            <p class="h5 pt-1">Daftar Pemasok (Berdasarkan Rute Optimal)</p>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <strong>Total Jarak Keseluruhan: </strong> <?= number_format($total_distance, 2) ?> km
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle; width: 50px;">No</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Usaha</th>
                            <th style="text-align: center; vertical-align: middle;">Lokasi</th>
                            <th style="text-align: center; vertical-align: middle;">Jenis</th>
                            <th style="text-align: center; vertical-align: middle;">Berat Stok (kg)</th>
                            <th style="text-align: center; vertical-align: middle;">Total Harga</th>
                            <th style="text-align: center; vertical-align: middle; width: 90px;">Jarak (KM)</th>
                            <th style="text-align: center; vertical-align: middle;">Keterangan</th>
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
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
                                    <td><?= $pemasok->jenis; ?></td>
                                    <td><?= $pemasok->jumlah_stok; ?> kg</td>
                                    <td><?= "Rp" . number_format($pemasok->total_harga, 0, ',', '.'); ?></td>
                                    <td><?= number_format($pemasok->distance, 2); ?> km</td>
                                    <td>
                                        <textarea class="form-control keterangan" name="keterangan[<?= $pemasok->id; ?>]" placeholder="Masukkan keterangan"></textarea>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary openMapBtn"
                                            data-koordinat="<?= $pemasok->lokasi ?>">
                                            <i class="bi bi-map"></i> Buka Maps
                                        </button>

                                        <button type="button" class="btn btn-success ambilStokBtn"
                                            data-id="<?= $pemasok->id; ?>"
                                            data-jumlah_stok="<?= $pemasok->jumlah_stok; ?>">
                                            <i class="bi bi-check-square"></i> Ambil Stok
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada pemasok tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <a class="btn btn-secondary" href="<?= base_url('pengelola'); ?>">Kembali</a>
            </div>
        </div>
    </div>
</main>

<form id="ambilStokForm" method="POST" action="<?= site_url('pengelola/add'); ?>">
    <!-- Input hidden akan ditambahkan secara dinamis -->
</form>

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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
            var jumlahStok = $(this).data('jumlah_stok');
            var keterangan = $(this).closest('tr').find('textarea.keterangan').val();

            if (!keterangan || keterangan.trim() === '') {
                $('#keteranganModal').modal('show');
                return;
            }

            $('#confirmAmbilStokBtn').data('id', idPemasok);
            $('#confirmAmbilStokBtn').data('jumlah_stok', jumlahStok);
            $('#confirmAmbilStokBtn').data('keterangan', keterangan);

            $('#ambilStokModal').modal('show');
        });

        // Ketika tombol konfirmasi ditekan
        $('#confirmAmbilStokBtn').click(function() {
            var idPemasok = $(this).data('id');
            var jumlahStok = $(this).data('jumlah_stok');
            var keterangan = $(this).data('keterangan');

            if (!idPemasok || !jumlahStok || !keterangan) {
                alert('Data tidak lengkap. Pastikan semua informasi tersedia.');
                return;
            }

            // Reset form sebelum menambahkan data baru
            $('#ambilStokForm').empty();

            // Tambahkan data ke form
            $('<input>').attr({
                type: 'hidden',
                name: 'id_pemasok[]',
                value: idPemasok
            }).appendTo('#ambilStokForm');

            $('<input>').attr({
                type: 'hidden',
                name: 'jumlah_stok[' + idPemasok + ']',
                value: jumlahStok
            }).appendTo('#ambilStokForm');

            $('<input>').attr({
                type: 'hidden',
                name: 'keterangan[' + idPemasok + ']',
                value: keterangan
            }).appendTo('#ambilStokForm');

            // Kirim data menggunakan AJAX
            $.ajax({
                url: $('#ambilStokForm').attr('action'),
                type: 'POST',
                data: $('#ambilStokForm').serialize(),
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response);
                    $('#ambilStokModal').modal('hide');

                    // Tunggu modal pertama selesai hidden baru tampilkan modal berhasil
                    $('#ambilStokModal').on('hidden.bs.modal', function() {
                        $('#berhasilAmbilStokModal').modal('show');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Gagal mengambil stok. Silakan coba lagi.');
                }
            });
        });

        // Handle modal berhasil ditutup
        $('#berhasilAmbilStokModal').on('hidden.bs.modal', function() {
            location.reload();
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