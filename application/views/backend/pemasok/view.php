<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Pemasok</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Daftar Pemasok</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            Silahkan untuk menambahkan dan mengecek stok ban bekas
                        </div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <?php if (!empty($daftar_stok)) : ?>
                                <?php
                                // Ambil status terbaru pemasok yang sedang login
                                $status_terbaru = $daftar_stok[0]->status;
                                ?>
                                <?php if ($status_terbaru == 'Sudah diambil'): ?>
                                    <a class="btn btn-primary border-0" href="<?= base_url('pemasok/add_view') ?>"><b>Tambah Stok</b></a>
                                <?php else: ?>
                                    <span class="text-danger">Tunggu sampai stok diambil</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="btn btn-primary border-0" href="<?= base_url('pemasok/add_view') ?>"><b>Tambah Stok</b></a>
                            <?php endif; ?>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Usaha</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Berat</th>
                                        <th>Harga per kg</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($daftar_stok)) : ?>
                                        <?php $no = 1;
                                        foreach ($daftar_stok as $stok) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $stok->nama_usaha ?></td>
                                                <td><?= date('d F Y, H:i', strtotime($stok->tanggal)); ?> WIB</td>
                                                <td><?= $stok->jenis ?></td>
                                                <td><?= $stok->jumlah_stok ?> kg</td>
                                                <td><?= "Rp" . number_format($stok->harga, 0, ',', '.') ?></td>
                                                <td><?= "Rp" . number_format($stok->total_harga, 0, ',', '.') ?></td>
                                                <td>
                                                    <?php
                                                    // Cocokkan sesuai nilai ENUM di database
                                                    if ($stok->status == 'Belum diambil'): ?>
                                                        <span class="badge bg-warning text-dark"><?= $stok->status ?></span>
                                                    <?php elseif ($stok->status == 'Sudah diambil'): ?>
                                                        <span class="badge bg-success"><?= $stok->status ?></span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary"><?= $stok->status ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success btn-sm border-0" onclick="window.location.href='<?= base_url('pemasok/detail/' . $stok->id) ?>'" style="cursor: pointer;">
                                                        <i class="bi bi-eye"></i> Detail
                                                    </button>
                                                    <?php if ($stok->status != 'Sudah diambil'): ?>
                                                        <button class="btn btn-danger btn-sm border-0" data-bs-toggle="modal" data-bs-target="#hapusModal-<?= $stok->id ?>" style="cursor: pointer;">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </button>

                                                        <!-- Modal Hapus -->
                                                        <div class="modal fade" id="hapusModal-<?= $stok->id ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah Anda yakin ingin menghapus stok dari pemasok <strong><?= $stok->nama ?></strong>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                                        <a href="<?= base_url('pemasok/delete/' . $stok->id) ?>" class="btn btn-danger"><i class="bi bi-check-circle"></i> Iya, Hapus</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6" align="center">Tidak ada data stok.</td>
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