<main id="main" class="main">
    <div class="pagetitle">
        <h1>Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pemasok</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Pemasok</h5>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Nama Usaha</th>
                                        <th>Nomor HP</th>
                                        <th>Berat</th>
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
                                                <td><?= date('d F Y H:i', strtotime($stok->tanggal)); ?></td>
                                                <td><?= $stok->nama ?></td>
                                                <td><?= $stok->nama_usaha ?></td>
                                                <td><?= $stok->no_hp ?></td>
                                                <td><?= $stok->jumlah_stok ?> kg</td>
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
                                                    <!-- <button class="btn btn-success btn-sm border-0" type="button" style="cursor: pointer;" onclick="window.location.href='edit-link.php';">Edit</button> -->
                                                    <button class="btn btn-danger btn-sm border-0" data-bs-toggle="modal" data-bs-target="#hapusModal-<?= $stok->id ?>" style="cursor: pointer;">Hapus</button>

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
                                                                    <a href="<?= base_url('pemasok/delete/' . $stok->id) ?>" class="btn btn-danger">Iya, Hapus</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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