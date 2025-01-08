<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Mitra Pengelola</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Mitra Pengelola</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Daftar Mitra Pengelola</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            Berikut adalah daftar pengelola yang terdaftar di sistem.
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                                                    <a class="btn btn-success btn-sm border-0" href="<?php echo site_url('admin/pengelola/riwayat/' . $pengelola->id); ?>">Detail</a>
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