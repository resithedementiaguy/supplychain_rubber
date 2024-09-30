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
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <?php if (!empty($daftar_stok)) : ?>
                                <?php 
                                // Ambil status terbaru pemasok yang sedang login
                                $status_terbaru = $daftar_stok[0]->status;
                                ?>
                                <?php if ($status_terbaru == 'Sudah diambil'): ?>
                                    <a class="btn btn-primary btn-sm border-0" style="cursor: pointer;" href="<?= base_url('pemasok/add_view')?>"><b>Tambah Stok</b></a>
                                <?php else: ?>
                                    <span class="text-danger">Tunggu sampai stok diambil</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

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
                                            <td><?= $no++?></td>
                                            <td><?= date('d F Y H:i', strtotime($stok->tanggal));?></td>
                                            <td><?= $stok->nama?></td>
                                            <td><?= $stok->nama_usaha?></td>
                                            <td><?= $stok->no_hp?></td>
                                            <td><?= $stok->jumlah_stok?> kg</td>
                                            <td>
                                                <?php 
                                                // Cocokkan sesuai nilai ENUM di database
                                                if ($stok->status == 'Belum diambil'): ?>
                                                    <span class="badge bg-warning text-dark"><?= $stok->status?></span>
                                                <?php elseif ($stok->status == 'Sudah diambil'): ?>
                                                    <span class="badge bg-success"><?= $stok->status?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><?= $stok->status ?></span>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <button class="btn btn-success btn-sm border-0" type="button" style="cursor: pointer;" onclick="window.location.href='edit-link.php';">Edit</button>
                                                <a class="btn btn-danger btn-sm border-0" style="cursor: pointer;" href="<?= site_url('pemasok/delete_stok/' . $stok->id) ?>">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" align="center">Tidak ada data stok.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
