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
                    <div class="card-body">
                        <h5 class="card-title">Daftar Mitra Pengelola</h5>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <a class="btn btn-primary btn-sm border-0" style="cursor: pointer;" href="<?= base_url('pengelola/add_view') ?>"><b>Ambil Stok</b></a>
                        </div>
                        <form action="<?= base_url('pengelola') ?>" method="POST">
                            <input type="hidden" value="<?php echo $this->session->userdata('mitra_id'); ?>" name="session_mitra_id" id="session_mitra_id">
                        </form>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Usaha</th>
                                        <th>Nomor HP</th>
                                        <th>Berat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($daftar_ambil)) : ?>
                                        <?php $no = 1;
                                        foreach ($daftar_ambil as $ambil) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $ambil->nama ?></td>
                                                <td><?= $ambil->nama_usaha ?></td>
                                                <td><?= $ambil->no_hp ?></td>
                                                <td><?= $ambil->jumlah_stok ?> kg</td>
                                                <td>
                                                    <a class="btn btn-success btn-sm border-0" href="<?php echo site_url('pengelola/detail/' . $ambil->id); ?>">Detail</a>
                                                    <button class="btn btn-danger btn-sm border-0" data-bs-toggle="modal" data-bs-target="#hapusModal-<?= $ambil->id ?>" style="cursor: pointer;">Hapus</button>

                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="hapusModal-<?= $ambil->id ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus stok dari pengelola <strong><?= $ambil->nama ?></strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                                    <a href="<?= base_url('pengelola/delete/' . $ambil->id) ?>" class="btn btn-danger">Iya, Hapus</a>
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
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>