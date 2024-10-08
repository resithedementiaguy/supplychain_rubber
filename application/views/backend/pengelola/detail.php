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
                                        <td><?php echo !empty($riwayat->tanggal_diolah) ? date('d F Y H:i', strtotime($riwayat->tanggal_diolah)) : '-'; ?></td>
                                        <td><?php echo !empty($riwayat->jumlah_mentah) ? $riwayat->jumlah_mentah . ' kg' : '-'; ?></td>
                                        <td>
                                            <button
                                                class="btn btn-success btn-sm border-0 olahButton"
                                                data-id_pengelola="<?= $riwayat->id ?>"
                                                data-jumlah_stok="<?= $riwayat->jumlah_stok ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDiolah">
                                                Olah
                                            </button>
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
                <h5 class="modal-title" id="modalDiolahLabel">Barang Diolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDiolah" method="POST" action="<?= base_url('pengelola/insert_olah') ?>">
                    <div class="mb-3">
                        <?php
                        date_default_timezone_set('Asia/Jakarta');
                        $tgl = date('Y-m-d H:i:s', time());
                        ?>
                        <label for="tanggalDiolah" class="form-label">Tanggal Diolah</label>
                        <input type="text" class="form-control" id="tanggalDiolah" name="tanggal" value="<?= $tgl ?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="beratMentah" class="form-label">Berat Mentah</label>
                        <input type="hidden" name="id_pengelola" value="<?php echo $detail_produk['id']; ?>">
                        <input type="hidden" name="jumlah_stok" id="jumlah_stok" value="<?php echo $detail_produk['jumlah_stok']; ?>">
                        <input type="number" class="form-control" name="jumlah_mentah" id="beratMentah" placeholder="Masukkan berat mentah (kg)" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="formDiolah">Simpan</button>
            </div>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php elseif ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
    function submitForm() {
        // Ambil nilai dari form
        const tanggalDiolah = document.getElementById('tanggalDiolah').value;
        const beratMentah = document.getElementById('beratMentah').value;
        const idPengelola = '<?= $id_pengelola; ?>';

        console.log("Tanggal Diolah: ", tanggalDiolah);
        console.log("Berat Mentah: ", beratMentah);
        console.log("ID Pengelola: ", idPengelola);

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: '<?= site_url('pengelola/insert_olah'); ?>',
            type: 'POST',
            data: {
                id_pengelola: idPengelola,
                tanggal: tanggalDiolah,
                jumlah_mentah: beratMentah
            },
            success: function(response) {
                // Lakukan sesuatu jika berhasil, misalnya refresh data atau tampilkan pesan
                alert('Data berhasil disimpan!');
                $('#modalDiolah').modal('hide');
            },
            error: function() {
                // Lakukan sesuatu jika gagal
                alert('Gagal menyimpan data!');
            }
        });
    }
</script>