<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Detail Riwayat Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pemasok</li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header text-white bg-success">
            <p class="h5 pt-1">Detail Riwayat Pemasok</p>
        </div>
        <div class="card-body">
            <div class="alert alert-success">
                Di bawah ini detail riwayat dari pemasok
            </div>

            <!-- Tabel untuk detail riwayat -->
            <table class="table" style="border-collapse: collapse; width: 100%;">
                <tbody>
                    <tr>
                        <th scope="row" style="width: 25%; border: none;">Nama</th>
                        <td style="border: none;"><?= $pemasok->nama ?? 'Tidak tersedia'; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Nama Usaha</th>
                        <td style="border: none;"><?= $pemasok->nama_usaha ?? 'Tidak tersedia'; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Tanggal Tambah</th>
                        <td style="border: none;"><?= $status_stok->tanggal ?? 'Tidak tersedia'; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Jenis</th>
                        <td style="border: none;"><?= $status_stok->jenis ?? 'Tidak tersedia'; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Berat (kg)</th>
                        <td style="border: none;"><?= $status_stok->jumlah_stok ? $status_stok->jumlah_stok . 'kg' : 'Tidak tersedia'; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Harga per kg</th>
                        <td style="border: none;">Rp<?= isset($status_stok->harga) ? number_format($status_stok->harga, 0, ',', '.') : 'Tidak tersedia'; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Total Harga</th>
                        <td style="border: none;">Rp<?= isset($status_stok->harga) ? number_format($status_stok->total_harga, 0, ',', '.') : 'Tidak tersedia'; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="border: none;">Status</th>
                        <td style="border: none;">
                            <?php if ($status_stok->status == 'Belum diambil'): ?>
                                <span class="badge rounded-pill bg-warning text-dark p-1 px-2"><?= $status_stok->status ?></span>
                            <?php elseif ($status_stok->status == 'Sudah diambil'): ?>
                                <span class="badge rounded-pill bg-success p-1 px-2"><?= $status_stok->status ?></span>
                            <?php else: ?>
                                <?= $status_stok->status ?? 'Tidak tersedia'; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php if ($status_stok->status === 'Sudah diambil' && !empty($pengelola)): ?>
                        <tr>
                            <th scope="row" style="border: none;">Diambil oleh</th>
                            <td style="border: none;"><?= $pengelola->nama_pengelola ?? 'Tidak tersedia'; ?></td>
                        </tr>
                        <tr>
                            <th scope="row" style="border: none;">Tanggal Diambil</th>
                            <td style="border: none;"><?= $pengelola->tanggal ?? 'Tidak tersedia'; ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="col-12 py-2 d-flex justify-content-between align-items-center">
                <a class="btn btn-secondary" href="<?= base_url('pemasok'); ?>">Kembali</a>
            </div>
        </div>
    </div>
</main>