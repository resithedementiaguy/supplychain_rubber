<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Detail Mitra Pengelola</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/pengelola/riwayat'); ?>">Mitra Pengelola</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/pengelola/riwayat/1'); ?>">Riwayat</a></li>
                <li class="breadcrumb-item active"><?php echo $detail_produk['nama_usaha_pemasok']; ?></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header text-white bg-success">
                <p class="h5 pt-1">Daftar Ambil Pemasok <?php echo $detail_produk['nama_usaha_pemasok']; ?></p>
            </div>
            <div class="card-body">
                <table class="table" style="border-collapse: collapse; width: 100%;">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 25%; border: none;">Nama Pemilik</th>
                            <td style="border: none;"><?php echo $detail_produk['nama_pengelola']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row" style="border: none;">Nama Usaha</th>
                            <td style="border: none;"><?php echo $detail_produk['nama_usaha_pengelola']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row" style="border: none;">Diambil Dari</th>
                            <td style="border: none;"><?php echo $detail_produk['nama_usaha_pemasok']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row" style="border: none;">Nomor HP Pengelola</th>
                            <td style="border: none;"><?php echo $detail_produk['no_hp_pengelola']; ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="alert alert-success">
                    Di bawah ini merupakan histori ambil dari pemasok
                </div>

                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Usaha Pemasok</th>
                                <th>Tanggal Diambil</th>
                                <th>Jumlah Stok</th>
                                <th>Tanggal Diolah</th>
                                <th scope="row">Jumlah Crumb Rubber</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($riwayat_pemasok)) : ?>
                                <?php $no = 1;
                                foreach ($riwayat_pemasok as $riwayat) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $riwayat->nama_usaha_pemasok ?></td>
                                        <td><?= date('d F Y H:i', strtotime($riwayat->tanggal)); ?></td>
                                        <td><?= $riwayat->jumlah_stok ?> kg</td>
                                        <td>
                                            <?php if (!empty($riwayat->tanggal_diolah)) : ?>
                                                <?= date('d F Y H:i', strtotime($riwayat->tanggal_diolah)); ?>
                                            <?php else : ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($riwayat->jumlah_mentah)) : ?>
                                                <?= $riwayat->jumlah_mentah . ' kg'; ?>
                                            <?php else : ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" align="center">Tidak ada riwayat untuk pemasok ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="modalDiolah" tabindex="-1" aria-labelledby="modalDiolahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white d-flex align-items-center">
                <h5 class="modal-title" id="modalDiolahLabel">Proses Pengolahan</h5>
                <button type="button" class="btn-close text-white bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDiolah" method="POST">
                    <div class="mb-3">
                        <label for="tanggalDiolah" class="form-label">Tanggal Diolah</label>
                        <input type="text" class="form-control" id="tanggalDiolah" name="tanggal" value="<?= date('Y-m-d H:i:s') ?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlahStok" class="form-label">Jumlah Stok (kg)</label>
                        <input type="text" class="form-control" id="jumlahStok" name="jumlah_stok" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="beratMentah" class="form-label">Total Berat Crumb Rubber</label>
                        <input type="hidden" name="id_ambil" id="id_ambil">
                        <input type="number" class="form-control" name="jumlah_mentah" id="beratMentah" placeholder="Masukkan total berat crumb rubber (kg)" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success" form="formDiolah">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Success -->
<div class="modal fade" id="modalSuccess" tabindex="-1" aria-labelledby="modalSuccessLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalSuccessLabel">Berhasil</h5>
                <button type="button" class="btn-close text-white bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data berhasil disimpan!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="location.reload();">Oke</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.olahButton', function() {
            const idAmbil = $(this).data('id_ambil');
            const jumlahStok = $(this).data('jumlah_stok');

            $('#jumlahStok').val(jumlahStok);
            $('#id_ambil').val(idAmbil);
        });

        $('#formDiolah').on('submit', function(event) {
            event.preventDefault();

            const formData = $(this).serialize();

            // Make AJAX request
            $.ajax({
                url: '<?= site_url('pengelola/insert_olah'); ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    try {
                        const jsonResponse = JSON.parse(response);
                        if (jsonResponse.success) {
                            $('#modalDiolah').modal('hide'); // Tutup modal sebelumnya
                            $('#modalSuccess').modal('show'); // Tampilkan modal sukses
                        } else {
                            alert('Gagal menyimpan data: ' + jsonResponse.message); // Ini opsional
                        }
                    } catch (e) {
                        alert('Gagal memproses respons: ' + e.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Gagal menyimpan data! Error: ' + error);
                }
            });
        });
    });
</script>