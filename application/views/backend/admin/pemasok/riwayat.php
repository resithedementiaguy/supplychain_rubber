<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Daftar History Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/pemasok'); ?>">Pemasok</a></li>
                <li class="breadcrumb-item active">History Pemasok</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Daftar History Pemasok</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            Berikut adalah daftar history pemasok yang terdaftar di sistem.
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Jumlah Stok</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($riwayat_stok)): ?>
                                        <?php foreach ($riwayat_stok as $index => $stok): ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= date('d-m-Y H:i:s', strtotime($stok['tanggal'])); ?></td>
                                                <td><?= $stok['jenis']; ?></td>
                                                <td><?= number_format($stok['jumlah_stok'], 2, ',', '.'); ?></td>
                                                <td><?= number_format($stok['harga'], 2, ',', '.'); ?></td>
                                                <td><?= number_format($stok['total_harga'], 2, ',', '.'); ?></td>
                                                <td><?= $stok['lokasi']; ?></td>
                                                <td><?= $stok['status']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data riwayat stok.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>