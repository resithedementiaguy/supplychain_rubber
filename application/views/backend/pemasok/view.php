<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="pb-2">Pemasok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Pemasok</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <p class="h5 pt-1">Daftar Pemasok</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            Silahkan untuk menambahkan dan mengecek stok ban bekas
                        </div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <?php if (!empty($daftar_stok)) : ?>
                                <?php
                                // Ambil status terbaru pemasok yang sedang login
                                $status_terbaru = $daftar_stok[0]->status;
                                ?>
                                <?php if ($status_terbaru == 'Sudah diambil'): ?>
                                    <a class="btn btn-primary border-0" href="<?= base_url('pemasok/add_view') ?>"><b>Tambah Stok</b></a>
                                <?php else: ?>
                                    <span class="badge rounded-pill bg-danger p-2 px-3"><i class="bi bi-exclamation-octagon me-1"></i> Tunggu sampai stok diambil</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="btn btn-primary border-0" href="<?= base_url('pemasok/add_view') ?>"><b>Tambah Stok</b></a>
                            <?php endif; ?>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Usaha</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Berat</th>
                                        <th>Harga per kg</th>
                                        <th>Total Harga</th>
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
                                                <td><?= $stok->nama_usaha ?></td>
                                                <td><?= date('d F Y, H:i', strtotime($stok->tanggal)); ?> WIB</td>
                                                <td><?= $stok->jenis_kendaraan ?></td>
                                                <td><?= $stok->jumlah_stok ?> kg</td>
                                                <td><?= "Rp" . number_format($stok->harga, 0, ',', '.') ?></td>
                                                <td><?= "Rp" . number_format($stok->total_harga, 0, ',', '.') ?></td>
                                                <td>
                                                    <?php
                                                    // Cocokkan sesuai nilai ENUM di database
                                                    if ($stok->status == 'Belum diambil'): ?>
                                                        <span class="badge rounded-pill bg-warning text-dark p-1 px-2"><?= $stok->status ?></span>
                                                    <?php elseif ($stok->status == 'Sudah diambil'): ?>
                                                        <span class="badge rounded-pill bg-success p-1 px-2"><?= $stok->status ?></span>
                                                    <?php else: ?>
                                                        <span class="badge rounded-pill bg-secondary p-1 px-2"><?= $stok->status ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success border-0" onclick="window.location.href='<?= base_url('pemasok/detail/' . $stok->id) ?>'" style="cursor: pointer;">
                                                        <i class="bi bi-eye"></i> Detail
                                                    </button>


                                                    <?php if ($stok->status != 'Sudah diambil'): ?>
                                                        <button class="btn btn-danger border-0" data-bs-toggle="modal" data-bs-target="#hapusModal-<?= $stok->id ?>" style="cursor: pointer;">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </button>
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
                                                                        <a href="<?= base_url('pemasok/delete/' . $stok->id) ?>" class="btn btn-danger"><i class="bi bi-check-circle"></i> Iya, Hapus</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
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

<!-- <button class="btn btn-primary border-0" data-bs-toggle="modal" data-bs-target="#editModal-<?= $stok->id ?>" style="cursor: pointer;">
    <i class="bi bi-pencil"></i> Edit
</button> -->
<!-- Modal Edit -->
<div class="modal fade" id="editModal-<?= $stok->id ?>" tabindex="-1" aria-labelledby="editModalLabel-<?= $stok->id ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $stok->id ?>">Edit Data Stok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?= base_url('pemasok/update/' . $stok->id) ?>">
                <div class="modal-body">
                    <input type="hidden" name="id_pemasok" value="<?= $stok->id_pemasok ?>">

                    <div class="mb-3">
                        <label for="tanggal-<?= $stok->id ?>" class="form-label">Tanggal</label>
                        <input type="text" class="form-control" id="tanggal-<?= $stok->id ?>" value="<?= date('Y-m-d H:i:s', strtotime($stok->tanggal)) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kendaraan-<?= $stok->id ?>" class="form-label">Jenis Kendaraan</label>
                        <select class="form-select jenis-kendaraan" id="jenis_kendaraan-<?= $stok->id ?>" name="jenis_kendaraan" required>
                            <option value="">- Pilih Jenis Kendaraan -</option>
                            <option value="Mobil" <?= $stok->jenis == 'Mobil' ? 'selected' : '' ?>>Mobil</option>
                            <option value="Motor" <?= $stok->jenis == 'Motor' ? 'selected' : '' ?>>Motor</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_stok-<?= $stok->id ?>" class="form-label">Jumlah Stok (kg)</label>
                        <input type="number" class="form-control jumlah-stok" id="jumlah_stok-<?= $stok->id ?>" name="jumlah_stok" value="<?= $stok->jumlah_stok ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga_ban-<?= $stok->id ?>" class="form-label">Harga Ban Bekas per kg</label>
                        <input type="text"
                            class="form-control harga-ban"
                            id="harga_ban-<?= $stok->id ?>"
                            name="harga_ban"
                            value="<?= number_format($harga_ban[$stok->jenis_kendaraan] ?? 0, 0, ',', '.') ?>"
                            readonly>
                        <p class="text-danger m-0 pt-1">*harga ban bekas selalu update</p>
                    </div>

                    <div class="mb-3">
                        <label for="total_harga-<?= $stok->id ?>" class="form-label">Total Harga Ban Bekas</label>
                        <input type="text" class="form-control total-harga" id="total_harga-<?= $stok->id ?>" name="total_harga" value="Rp <?= number_format($stok->total_harga, 0, ',', '.') ?>" readonly>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.jenis-kendaraan').forEach(select => {
        select.addEventListener('change', function() {
            const id = this.id.split('-')[1];
            const jenis = this.value;

            if (jenis) {
                fetch(`<?= base_url('pemasok/get_harga/') ?>${jenis}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.harga) {
                            document.getElementById(`harga_ban-${id}`).value = new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(data.harga);

                            calculateTotal(id);
                        }
                    });
            }
        });
    });

    document.querySelectorAll('.jumlah-stok').forEach(input => {
        input.addEventListener('input', function() {
            const id = this.id.split('-')[1];
            calculateTotal(id);
        });
    });

    function calculateTotal(id) {
        const hargaBan = parseFloat(document.getElementById(`harga_ban-${id}`).value.replace(/[^\d]/g, '')) || 0;
        const jumlahStok = parseFloat(document.getElementById(`jumlah_stok-${id}`).value) || 0;

        const totalHarga = hargaBan * jumlahStok;

        document.getElementById(`total_harga-${id}`).value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(totalHarga);
    }
</script>