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
                            <a class="btn btn-primary btn-sm border-0" style="cursor: pointer;" href="<?= base_url('pengelola/add_view')?>" ><b>Ambil Stok</b></a>
                        </div>

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
                                            <td><?= $no++?></td>
                                            <td><?= $ambil->nama?></td>
                                            <td><?= $ambil->nama_usaha?></td>
                                            <td><?= $ambil->no_hp?></td>
                                            <td><?= $ambil->jumlah_stok?></td>
                                            <td>
                                                <button class="btn btn-success btn-sm border-0" type="button" style="cursor: pointer;" onclick="window.location.href='edit-link.php';">Edit</button>
                                                <button class="btn btn-danger btn-sm border-0" style="cursor: pointer;" onclick="window.location.href='delete-link.php';">Hapus</button>
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