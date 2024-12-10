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
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahStokModal">
                                <b>Tambah Stok</b>
                            </button>
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

    <!-- Modal for Tambah Stok -->
    <div class="modal fade" id="tambahStokModal" tabindex="-1" aria-labelledby="tambahStokModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="tambahStokModalLabel">Tambah Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="row g-3 p-3" method="post" action="<?= site_url('hargaban/create') ?>">
                    <div class="modal-body">
                        <div class="col-12">
                            <label for="jenis" class="form-label">Jenis Kendaraan</label>
                            <select class="form-select" id="jenis" name="jenis" required>
                                <option value="">- Pilih Jenis Kendaraan -</option>
                                <option value="Mobil">Mobil</option>
                                <option value="Motor">Motor</option>
                            </select>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="harga" class="form-label">Harga Ban Bekas</label>
                            <input
                                type="number"
                                class="form-control"
                                id="harga"
                                name="harga"
                                placeholder="Masukkan Harga Ban Bekas"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>