<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Riwayat Mitra Pengelola</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/pengelola/riwayat'); ?>">Mitra Pengelola</a></li>
                <li class="breadcrumb-item active">Riwayat</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Daftar Riwayat Pengelola</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            Berikut adalah daftar riwayat pengelola yang terdaftar di sistem.
                        </div>
                        <form action="<?= base_url('pengelola') ?>" method="POST">
                            <input type="hidden" value="<?php echo $this->session->userdata('mitra_id'); ?>" name="session_mitra_id" id="session_mitra_id">
                        </form>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Usaha</th>
                                        <th>Nomor HP</th>
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
                                                <td>
                                                    <a class="btn btn-success btn-sm border-0" href="<?php echo site_url('admin/pengelola/detail/' . $ambil->id); ?>"><i class="bi bi-eye"></i> Detail</a>
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