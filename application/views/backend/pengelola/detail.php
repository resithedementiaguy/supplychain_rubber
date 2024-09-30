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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Barang</h5>
                        <button type="button" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalDiolah">
                            Input Diolah
                        </button>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama Pemilik</th>
                                    <td><?php echo $detail_produk['nama_pengelola']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Usaha</th>
                                    <td><?php echo $detail_produk['nama_usaha_pengelola']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Diambil Dari</th>
                                    <td><?php echo $detail_produk['nama_usaha_pemasok']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor HP Pengelola</th>
                                    <td><?php echo $detail_produk['no_hp_pengelola']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Diambil</th>
                                    <td><?php echo date('d F Y H:i', strtotime($detail_produk['tanggal'])); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah Stok</th>
                                    <td><?php echo $detail_produk['jumlah_stok']; ?> kg</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Diolah</th>
                                    <td>
                                        <?php echo !empty($detail_produk['tanggal_diolah']) ? date('d F Y H:i', strtotime($detail_produk['tanggal_diolah'])) : '-'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah Mentah</th>
                                    <td>
                                        <?php echo !empty($detail_produk['jumlah_mentah']) ? $detail_produk['jumlah_mentah'] . ' kg' : '-'; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="btn btn-sm btn-secondary" href="<?= base_url('pengelola'); ?>">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
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