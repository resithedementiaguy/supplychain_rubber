<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Harga Ban Bekas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Harga Ban Bekas</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Daftar Harga Ban Bekas</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            Silahkan untuk menambahkan dan mengecek untuk harga dari stok ban bekas
                        </div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahStokModal">
                                <b>Tambah Stok</b>
                            </button>
                        </div>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                    <th>Waktu Input</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php
                                $no = 1;
                                foreach ($harga_ban as $item): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->jenis ?></td>
                                        <td><?= 'Rp' . number_format($item->harga, 0, ',', '.') ?></td>
                                        <td><?= formatTanggal($item->ins_time); ?></td>
                                        <td>
                                            <button
                                                class="btn btn-success border-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal-<?= $item->id ?>"
                                                style="cursor: pointer;">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>

                                            <button
                                                class="btn btn-danger border-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapusModal-<?= $item->id ?>"
                                                style="cursor: pointer;">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit Harga Ban -->
                                    <div class="modal fade" id="editModal-<?= $item->id ?>" tabindex="-1" aria-labelledby="editModalLabel-<?= $item->id ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success text-white d-flex align-items-center">
                                                    <h5 class="modal-title" id="editModalLabel-<?= $item->id ?>">Edit Harga Ban Bekas</h5>
                                                    <button type="button" class="btn-close text-white bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="<?= site_url('hargaban/update/' . $item->id) ?>">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="jenis-<?= $item->id ?>" class="form-label">Jenis Kendaraan</label>
                                                            <select class="form-select" id="jenis-<?= $item->id ?>" name="jenis" required>
                                                                <option value="">- Pilih Jenis Kendaraan -</option>
                                                                <option value="Mobil" <?= $item->jenis === 'Mobil' ? 'selected' : '' ?>>Mobil</option>
                                                                <option value="Motor" <?= $item->jenis === 'Motor' ? 'selected' : '' ?>>Motor</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga-<?= $item->id ?>" class="form-label">Harga Ban Bekas</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="harga-<?= $item->id ?>"
                                                                name="harga"
                                                                value="<?= $item->harga ?>"
                                                                placeholder="Masukkan Harga Ban Bekas"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="hapusModal-<?= $item->id ?>" tabindex="-1" aria-labelledby="hapusModalLabel-<?= $item->id ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white d-flex align-items-center">
                                                    <h5 class="modal-title" id="hapusModalLabel-<?= $item->id ?>">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close text-white bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data ini? <br>
                                                    <strong>Jenis:</strong> <?= $item->jenis ?> <br>
                                                    <strong>Harga:</strong> <?= $item->harga ?> <br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a href="<?= site_url('hargaban/delete/' . $item->id) ?>" class="btn btn-danger">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Tambah Stok -->
    <div class="modal fade" id="tambahStokModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white d-flex align-items-center">
                    <h5 class="modal-title">Tambah Stok</h5>
                    <button type="button" class="btn-close text-white bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?= site_url('hargaban/create') ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Kendaraan</label>
                            <select class="form-select" id="jenis" name="jenis" required>
                                <option value="">- Pilih Jenis Kendaraan -</option>
                                <option value="Mobil">Mobil</option>
                                <option value="Motor">Motor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Ban Bekas</label>
                            <input
                                type="text"
                                class="form-control"
                                id="harga"
                                name="harga"
                                placeholder="Masukkan Harga Ban Bekas"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</main>

<?php
function formatTanggal($datetime)
{
    $bulan = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    $timestamp = strtotime($datetime);
    $bulanIndo = $bulan[date('F', $timestamp)];
    return date('d', $timestamp) . ' ' . $bulanIndo . ' ' . date('Y, H:i', $timestamp) . ' WIB';
}
?>