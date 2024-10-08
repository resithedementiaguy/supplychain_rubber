<main id="main" class="main">
    <div class="pagetitle">
        <h1>Detail Produk Pengelola</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Mitra Pengelola</li>
                <li class="breadcrumb-item">Detail</li>
                <li class="breadcrumb-item active">Sentosa Gaming</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
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
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Usaha Pemasok</th>
                                <th>Tanggal Diambil</th>
                                <th>Jumlah Stok</th>
                                <th>Tanggal Diolah</th>
                                <th scope="row">Jumlah Mentah</th>
                                <th>Aksi</th>
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
                                        <td>
                                            <?php if (empty($riwayat->tanggal_diolah)) : // Cek jika tanggal diolah kosong 
                                            ?>
                                                <button class="btn btn-success btn-sm border-0 olahButton"
                                                    data-id_ambil="<?= $riwayat->id_ambil ?>"
                                                    data-jumlah_stok="<?= $riwayat->jumlah_stok ?>"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDiolah">
                                                    Olah
                                                </button>
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

        <div class="d-flex justify-content-between align-items-center">
            <a class="btn btn-secondary" href="<?= base_url('pengelola'); ?>">Kembali</a>
        </div>
    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="modalDiolah" tabindex="-1" aria-labelledby="modalDiolahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDiolahLabel">Proses Pengolahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <label for="beratMentah" class="form-label">Berat Mentah</label>
                        <input type="hidden" name="id_ambil" id="id_ambil">
                        <input type="number" class="form-control" name="jumlah_mentah" id="beratMentah" placeholder="Masukkan berat mentah (kg)" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="formDiolah">Simpan</button>
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
                    console.log(response);
                    try {
                        const jsonResponse = JSON.parse(response);
                        if (jsonResponse.success) {
                            alert('Data berhasil disimpan!');
                            $('#modalDiolah').modal('hide');
                            location.reload(); // Tambahkan ini untuk refresh halaman
                        } else {
                            alert('Gagal menyimpan data: ' + jsonResponse.message);
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