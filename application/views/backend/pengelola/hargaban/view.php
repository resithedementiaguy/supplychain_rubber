<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Pengelola</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Pengelola</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Daftar Harga Ban Bekas</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            Silahkan untuk menambahkan dan mengecek stok ban bekas
                        </div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <a class="btn btn-primary border-0" href="<?= site_url('hargaban/create') ?>"><b>Tambah Stok</b></a>
                        </div>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                    <th>Waktu Input</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php foreach ($harga_ban as $item): ?>
                                    <tr>
                                        <td><?= $item->id ?></td>
                                        <td><?= $item->jenis ?></td>
                                        <td><?= $item->harga ?></td>
                                        <td><?= $item->ins_time ?></td>
                                        <td>
                                            <a href="<?= site_url('hargaban/edit/' . $item->id) ?>">Edit</a>
                                            <a href="<?= site_url('hargaban/delete/' . $item->id) ?>" onclick="return confirm('Yakin?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>