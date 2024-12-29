<main id="main" class="main">
    <div class="pagetitle">
        <h1>Mitra Pengelola</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Mitra Pengelola</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Daftar History Pengelola</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            Silahkan untuk menambahkan dan mengecek stok crumb rubber
                        </div>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Mitra</th>
                                        <th>Nomor HP</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($daftar_pengelola)) : ?>
                                        <?php $no = 1;
                                        foreach ($daftar_pengelola as $pengelola) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $pengelola->nama ?></td>
                                                <td><?= $pengelola->nama_usaha ?></td>
                                                <td><?= $pengelola->no_hp ?></td>
                                                <td><?= $pengelola->alamat ?></td>
                                                <td>
                                                    <a class="btn btn-success btn-sm border-0" href="<?php echo site_url('admin/pengelola/detail/' . $pengelola->id); ?>">Detail</a>
                                                    <button class="btn btn-danger btn-sm border-0" data-bs-toggle="modal" data-bs-target="#hapusModal-<?= $pengelola->id ?>" style="cursor: pointer;">Hapus</button>

                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="hapusModal-<?= $pengelola->id ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus stok dari pengelola <strong><?= $pengelola->nama ?></strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                                    <a href="<?= base_url('pengelola/delete/' . $pengelola->id) ?>" class="btn btn-danger">Iya, Hapus</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6" align="center">Tidak ada data ambil.</td>
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