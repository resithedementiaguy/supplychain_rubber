<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item">Pemasok</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Daftar Pemasok</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            Berikut adalah daftar pemasok yang terdaftar di sistem.
                        </div>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Usaha</th>
                                        <th>Nomor HP</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($daftar_pemasok)) : ?>
                                        <?php $no = 1;
                                        foreach ($daftar_pemasok as $pemasok) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $pemasok->nama ?></td>
                                                <td><?= $pemasok->nama_usaha ?></td>
                                                <td><?= $pemasok->no_hp ?></td>
                                                <td><?= $pemasok->alamat ?></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm border-0" type="button" style="cursor: pointer;"
                                                        onclick="window.location.href='<?= base_url('admin/pemasok/riwayat/' . $pemasok->id); ?>';">
                                                        Lihat Riwayat
                                                    </button>
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